<?php

	class automatico
	{
		public function recursosAtt($usuario_id)
		{
			global $pdo_mysql;
			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`uid` = $usuario_id");
			$recurso = ($aldeia["producao"] / 3600) * (time() - $aldeia["ult_att"]);
			$pdo_mysql->update_pdo('aldeia',"armazem = armazem + $recurso","`id` = $usuario_id");
			echo "<b>sua producao por hora:</b> {$aldeia["producao"]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
		}

		public function ultima_checagemAtt($usuario_id)
		{
			global $pdo_mysql;
			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$usuario_id}");
			$ult_att = time();
			$pdo_mysql->update_pdo("aldeia","ult_att = $ult_att","`uid` = $usuario_id");
		}

	}

?>
