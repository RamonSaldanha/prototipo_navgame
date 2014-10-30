<?php

	class aldeia
	{
		public function multiAldeias($uid=null,$mudar_aldeia=null)
		{
			global $pdo_mysql;

			if(isset($mudar_aldeia)):
				$_SESSION['aid'] = $mudar_aldeia;
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
		}

		public function checarArmazem($aid)
		{
			global $construcoes;
			$armazem = ARMAZEM_MINIMO;
			if($construcoes->checarSeExisteEd($aid,1) == "existe"):
				$armazem += $construcoes->checarPropEdificio(1)['atributo'];
			endif;

			return $armazem;
		}

		public function calcularProdEstoque($aid)
		{

			global $recursos_data,$pdo_mysql;

			$rec_array = array();

			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
			// aqui ele vai imprimir o recursos_data.php pra verificar se você produz e quanto produz, calcular e registrar
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
			// '2' é o id da construção da madereira, ele vai verificar se existe uma madereira, e vai adicionar
			// o bonus na producao, de acordo com a propriedade do edificio...
			if($construcoes->checarSeExisteEd($aid,2) == "existe"):
				$madeira += $construcoes->checarPropEdificio(2)['atributo'];
			endif;

			return $madeira;
		}

		private function calcularProdComida($aid)
		{
			global $construcoes;
			$comida = PROD_MINIMA;
			if($construcoes->checarSeExisteEd($aid,3) == "existe"):
				$comida += $construcoes->checarPropEdificio(3)['atributo'];
			endif;
			return $comida;
		}

		public function recursosAtt($aid)
		{

			global $pdo_mysql;
			foreach($this->calcularProdEstoque($aid) as $recursos):
				$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
				$recurso_calcular = ($recursos["producao"] / 3600) * (time() - $aldeia["ult_att"]);

				if($aldeia["madeira"] + $aldeia["comida"] <= $this->checarArmazem($aid)):
					$pdo_mysql->update_pdo('aldeia',"{$recursos["recurso_nome"]} = {$recursos["recurso_nome"]} + $recurso_calcular","`id` = {$aid}");
				endif;
			endforeach;
			// echo "<b>sua producao por hora:</b> {$this->calcularProd($_SESSION["aid"])[1]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
		}
	}

?>
