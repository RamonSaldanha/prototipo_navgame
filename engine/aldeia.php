<?php

	class aldeia
	{
		public function calcularProd()
		{
			$producao_madeira = PROD_MADEIRA_MINIMA * 14;
			$producao_comida = PROD_COMIDA_MINIMA;
			global $recursos_data;
			$rec_array = array();

			foreach($recursos_data as $recurso):
				$rec_array[] = preg_replace("/%produz%/", $producao_.$recurso["recurso_nome"], $recursos_data[$recurso['id']]);
			endforeach;

			return $rec_array;
		}

		public function recursosAtt($aid)
		{
			$this->calcularProd();
			// global $pdo_mysql;
			// $aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
			// foreach($this->calcularProd($aid) as $recurso_prop):
			// 	$recurso = ($recurso_prop["producao"] / 3600) * (time() - $aldeia["ult_att"]);
			// 	if($aldeia["madeira"] <= ARMAZEM_MINIMO):
			// 		$pdo_mysql->update_pdo('aldeia',"{$recurso_prop["recurso_nome"]} = {$recurso_prop["recurso_nome"]} + $recurso","`id` = {$aid}");
			// 	endif;
			// endforeach;

			// echo "<b>sua producao por hora:</b> {$this->calcularProd($_SESSION["aid"])[1]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
		}
	}

?>
