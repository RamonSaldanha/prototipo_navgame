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

		public function verificarPesquisas($uid)
		{
			global $pdo_mysql,$rec_pesq,$militar_pesq,$economia_pesq;
			$pesq_select = $pdo_mysql->select_pdo_where("pesquisa","`uid` = {$uid}");
			foreach($pesq_select as $tabela => $valor):
				if($tabela != "id" && $tabela != "uid"):
					if($valor > 0):
						$tipo_pesq = substr($tabela, 0, -1);
						$array = $$tipo_pesq;
						$nivel_pesq = substr($tabela, -1);
						echo $array[$nivel_pesq][$valor]['nome_subpesq']. "<br />";

						// echo "sua pesquisa é nível:" .$valor. "<br />";
					endif;
				endif;
			endforeach;
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

		// aqui checa o quanto você pode abrigar na sua aldeia;
		public function checarLimiteHabitacional($aid)
		{
			global $construcoes;
			$limite_habitacional = LIMITE_HABITACIONAL_MIN;
			if($construcoes->checarSeExisteEd($aid,0) == "existe"):
				$checar_prop_ed = $construcoes->checarPropEdificio(0);
				$limite_habitacional += $checar_prop_ed['atributo'];
			endif;

			return $limite_habitacional;
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

					case "agua":
						// caso o nome do recurso seja madeira, ele vai entrar e calcular de acordo com sua producao, ele substitui
						// %produz% e %estocado% pela producao e o estoque real.. e adiciona a array $rec_array[];
						$modelo[0] = '/%produz%/';
						$modelo[1] = '/%estocado%/';
						$substituir[0] = $this->calcularProdAgua($aid);
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
			unset($aldeia);
		}

		// calcula quanto você recebe de população quando vem para seu conjunto habitacional
		public function calcularRecPopulacao($aid)
		{
			$rec_populacao = RECEBE_POPULACAO_MIN;
			return $rec_populacao;
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

		public function calcularConsumoPop($aid){
			global $pdo_mysql,$unidade_data;
			$checar_unidades = $pdo_mysql->select_pdo_where("unidades","`aid` = {$aid}");
			$consumo = array();
			$consumo['comida'] = 0;
			$consumo['agua'] = 0;
			$unidade_id = 1;
			foreach($unidade_data as $unidades){
				$unidade_id1 = "u" . $unidade_id;
				$consumo['comida'] = $consumo['comida'] + ($unidades["consumo_comida"] * $checar_unidades["{$unidade_id1}"]);
				$consumo['agua'] = $consumo['agua'] + ($unidades["consumo_agua"] * $checar_unidades["{$unidade_id1}"]);
				$unidade_id++;
			}
			return $consumo;
		}

		private function calcularProdAgua($aid)
		{
			global $construcoes;
			$agua = PROD_MINIMA;

			if($construcoes->checarSeExisteEd($aid,6) == "existe"):
				$checar_prop_ed = $construcoes->checarPropEdificio(4);
				$consumo = $this->calcularConsumoPop($aid);
				$agua += $checar_prop_ed['atributo'] - $consumo['agua'];
			endif;

			return $agua;
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
		public function tempoBeneficioAtt($aid,$beneficio_tipo,$tempo)
		{
			global $pdo_mysql;
			if($tempo > 0):
				$ult_att = time() + $tempo;
				$pdo_mysql->update_pdo("aldeia","temp_{$beneficio_tipo} = $ult_att","`id` = {$aid}");
			endif;
		}

		// essa função é o complemento da função anterior, você irá receber o benefício que produziu
		public function receberBeneficio($aid,$beneficio_tipo,$beneficio_subtipo,$atributo)
		{
			global $pdo_mysql;
			$ult_att = time() + $tempo;
			if($beneficio_tipo == "aldeia"):
				$pdo_mysql->update_pdo("aldeia","{$beneficio_subtipo} = {$beneficio_subtipo} + {$atributo}","`id` = {$aid}");
			else:
				$pdo_mysql->update_pdo("{$beneficio_tipo}","{$beneficio_subtipo} = {$beneficio_subtipo} + {$atributo}","`id` = {$aid}");
			endif;
		}

		public function recursosAtt($aid)
		{
			global $pdo_mysql;
			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
			// aqui ele calcula recurso por recurso sua produção por hora
			foreach($this->calcularProdEstoque($aid) as $recursos):
				$recurso_calcular[$recursos['recurso_nome']] = ($recursos["producao"] / 3600) * (time() - $aldeia["ult_att"]). "";
				$recurso_estoque[$recursos['recurso_nome']] = $aldeia[$recursos["recurso_nome"]];
			endforeach;


			// consumo de comida por hr total...
			$consumo = $this->calcularConsumoPop($aid);
			$comida_por_hr = ($consumo['comida'] / 3600) * (time() - $aldeia["ult_att"]);
			

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

			if($aldeia['agua'] >= $this->checarArmazem($aid)):
				$recurso_calcular['agua'] = 0;
				$pdo_mysql->update_pdo('aldeia',"`agua` = {$this->checarArmazem($aid)}","`id` = {$aid}");
			else:
				$pdo_mysql->update_pdo('aldeia',"`agua` = agua + {$recurso_calcular['agua']}","`id` = {$aid}");
			endif;

			if($aldeia['comida'] >= $this->checarArmazem($aid)):
				$recurso_calcular['comida'] = 0;
				$pdo_mysql->update_pdo('aldeia',"`comida` = {$this->checarArmazem($aid)}","`id` = {$aid}");
			endif;

			$pdo_mysql->update_pdo('aldeia',"`comida` = comida - {$comida_por_hr}","`id` = {$aid}");

		}
	}

?>
