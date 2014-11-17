<?php

	class aldeia
	{
		public function multiAldeias($uid=null,$mudar_aldeia=null)
		{
			global $pdo_mysql;
			
			if(isset($mudar_aldeia)):
				$checar_mapa = $pdo_mysql->select_pdo_where("mapa","`aid` = {$mudar_aldeia}");
				$_SESSION['coordenadas'] = $checar_mapa['x'] .";" . $checar_mapa['y'];				$_SESSION['aid'] = $mudar_aldeia;
				header("Location: aldeia.php");
			endif;

			if(isset($uid)):
				$multi_aldeias = $pdo_mysql->select_pdo("aldeia","`uid` = {$uid}");
				$aldeias_array = array();
				foreach($multi_aldeias as $aldeias):
					$aldeias_array[] = $aldeias;
				endforeach;
				return $aldeias_array;
			endif;

			unset($multi_aldeias);
		}

		public function checarArmazem($aid)
		{
			global $construcoes;
			$armazem = ARMAZEM_MINIMO;
			if($construcoes->checarSeExisteEd($aid,1) == "existe"):
				$checar_prop_ed = $construcoes->checarPropEdificio(1);
				$armazem += $checar_prop_ed['atributo'];
			endif;

			return $armazem;
		}

		public function calcularProdEstoque($aid)
		{

			global $recursos_data,$pdo_mysql;

			$rec_array = array();

			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
			// aqui ele vai imprimir o recursos_data.php pra verificar se voc� produz e quanto produz, calcular e registrar
			// e uma array todas propriedades da sua producao;
			foreach($recursos_data as $recurso):
				switch ($recurso["recurso_nome"]):
					case "madeira":
						// caso o nome do recurso seja madeira, ele vai entrar e calcular de acordo com sua producao, ele substitui
						// %produz% e %estocado% pela producao e o estoque real.. e adiciona a array $rec_array[];
						$modelo[0] = '/%produz%/';
						$modelo[1] = '/%estocado%/';
						$substituir[0] = $this->calcularProdMadeira($aid);
						$substituir[1] = round($aldeia[$recurso["recurso_nome"]]);
						$rec_array[] = preg_replace($modelo, $substituir, $recursos_data[$recurso['id']]);
					break;



					case "comida":
						$modelo[0] = '/%produz%/';
						$modelo[1] = '/%estocado%/';
						$substituir[0] = $this->calcularProdComida($aid);
						$substituir[1] = round($aldeia[$recurso["recurso_nome"]]);

						$rec_array[] = preg_replace($modelo, $substituir, $recursos_data[$recurso['id']]);
					break;

					case "pedra":
						// caso o nome do recurso seja madeira, ele vai entrar e calcular de acordo com sua producao, ele substitui
						// %produz% e %estocado% pela producao e o estoque real.. e adiciona a array $rec_array[];
						$modelo[0] = '/%produz%/';
						$modelo[1] = '/%estocado%/';
						$substituir[0] = $this->calcularProdPedra($aid);
						$substituir[1] = round($aldeia[$recurso["recurso_nome"]]);
						$rec_array[] = preg_replace($modelo, $substituir, $recursos_data[$recurso['id']]);
					break;

					case "carvao":
					// exemplo caso eu queira adicionar outro recurso para produzir a principio eu teria que adicionar outra funcao
					// pra calcular o quanto produz aqui.
						echo "carvao aqui";
					break;
				endswitch;
			endforeach;

			return $rec_array;
		}

		private function calcularProdMadeira($aid)
		{
			global $construcoes;
			$madeira = PROD_MINIMA;
			// '2' � o id da constru��o da madereira, ele vai verificar se existe uma madereira, e vai adicionar
			// o bonus na producao, de acordo com a propriedade do edificio...
			if($construcoes->checarSeExisteEd($aid,2) == "existe"):
				$checar_prop_ed = $construcoes->checarPropEdificio(2);
				$madeira += $checar_prop_ed['atributo'];
			endif;

			return $madeira;
		}

		private function calcularProdPedra($aid)
		{
			global $construcoes;
			$pedra = PROD_MINIMA;
			if($construcoes->checarSeExisteEd($aid,4) == "existe"):
				$checar_prop_ed = $construcoes->checarPropEdificio(4);
				$pedra += $checar_prop_ed['atributo'];
			endif;
			return $pedra;
		}

		private function calcularProdComida($aid)
		{
			global $construcoes;
			$comida = PROD_MINIMA;
			if($construcoes->checarSeExisteEd($aid,3) == "existe"):
				$checar_prop_ed = $construcoes->checarPropEdificio(3);
				$comida += $checar_prop_ed['atributo'];
			endif;
			return $comida;
		}

		// essa função poderá ser utilizada nas próximas criações de recursos
		// recursos que não produzirão automaticamente, poderão ser feitos com essa função.
		// public function tempoRecursoAtt($aid,$recurso,$tempo)
		// {
		// 	global $pdo_mysql;
		// 	switch($tempo):
		// 		case "1hrs":
		// 			$tempo = 3600;
		// 		break;
		// 		case "2hrs":
		// 			$tempo = 3600 * 2;
		// 		break;
		// 		case "4hrs":
		// 			$tempo = 3600 * 4;
		// 		break;
		// 		case "6hrs":
		// 			$tempo = 3600 * 6;
		// 		break;
		// 	endswitch;
		// 	$ult_att = time() + $tempo;
		// 	$pdo_mysql->update_pdo("aldeia","temp_{$recurso} = $ult_att","`id` = {$aid}");
		// 	header("Location: aldeia.php");
		// }

		public function recursosAtt($aid)
		{
			global $pdo_mysql;

			// aqui ele calcula recurso por recurso sua produção por hora
			foreach($this->calcularProdEstoque($aid) as $recursos):
				$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
				$recurso_calcular[$recursos['recurso_nome']] = ($recursos["producao"] / 3600) * (time() - $aldeia["ult_att"]). "";
				$recurso_estoque[$recursos['recurso_nome']] = $aldeia[$recursos["recurso_nome"]];
			endforeach;

			// aqui ele vai limitar o armazém e prosseguir nas produções
			if($aldeia['madeira'] >= $this->checarArmazem($aid)):
				$recurso_calcular['madeira'] = 0;
				$pdo_mysql->update_pdo('aldeia',"`madeira` = {$this->checarArmazem($aid)}","`id` = {$aid}");
			else:
				$pdo_mysql->update_pdo('aldeia',"`madeira` = madeira + {$recurso_calcular['madeira']}","`id` = {$aid}");
			endif;

			if($aldeia['pedra'] >= $this->checarArmazem($aid)):
				$recurso_calcular['pedra'] = 0;
				$pdo_mysql->update_pdo('aldeia',"`pedra` = {$this->checarArmazem($aid)}","`id` = {$aid}");
			else:
				$pdo_mysql->update_pdo('aldeia',"`pedra` = pedra + {$recurso_calcular['pedra']}","`id` = {$aid}");
			endif;

			if($aldeia['comida'] >= $this->checarArmazem($aid)):
				$recurso_calcular['comida'] = 0;
				$pdo_mysql->update_pdo('aldeia',"`comida` = {$this->checarArmazem($aid)}","`id` = {$aid}");
			endif;

		}
	}

?>
