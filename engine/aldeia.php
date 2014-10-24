<?php

	class aldeia
	{
		public function calcularProd()
		{
			$producao_madeira = PROD_MADEIRA_MINIMA * 14;
			$producao_comida = PROD_COMIDA_MINIMA;

			$recursos_data = array(
				array(
					"id" => "0",
					"recurso_nome" => "Comida",
					"producao" => "{$producao_comida}"
				),
				array(
					"id" => "1",
					"recurso_nome" => "Madeira",
					"producao" => "{$producao_madeira}"
				)
			);

			return $recursos_data;
		}

		public function recursosAtt($aid)
		{
			global $pdo_mysql;
			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
			foreach($this->calcularProd($aid) as $recurso_prop):
				$recurso = ($recurso_prop["producao"] / 3600) * (time() - $aldeia["ult_att"]);
				if($aldeia["armazem"] <= ARMAZEM_MINIMO):
					$pdo_mysql->update_pdo('aldeia',"{$recurso_prop["recurso_nome"]} = {$recurso_prop["recurso_nome"]} + $recurso","`id` = {$aid}");
				endif;
			endforeach;

			// echo "<b>sua producao por hora:</b> {$this->calcularProd($_SESSION["aid"])[1]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
		}
	}

?>
