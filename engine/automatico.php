<?php

	class automatico
	{
		public function recursosAtt($usuario_id)
		{
			global $pdo_mysql;
			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`uid` = $usuario_id");
			$recurso = ($aldeia["producao"] / 3600) * (time() - $aldeia["ult_att"]);
			if($aldeia["armazem"] <= ARMAZEM_MINIMO):
				$pdo_mysql->update_pdo('aldeia',"armazem = armazem + $recurso","`id` = $usuario_id");
			endif;
			echo "<b>sua producao por hora:</b> {$aldeia["producao"]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
		}

		public function ultima_checagemAtt($usuario_id)
		{
			global $pdo_mysql;
			$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = {$usuario_id}");
			$ult_att = time();
			$pdo_mysql->update_pdo("aldeia","ult_att = $ult_att","`uid` = $usuario_id");
		}

		public function terminarConstrucao($aldeia_id)
		{
			global $pdo_mysql;
			foreach($pdo_mysql->select_pdo("ed_construcao","`aid` = {$aldeia_id}") as $edificios_construcao):
				if($edificios_construcao->tempo_construcao < time()):
					$pdo_mysql->update_pdo('edificios',"`{$edificios_construcao->terreno}` = \"{$edificios_construcao->edificio_tipo}\"","`aid` = {$aldeia_id}");
					$pdo_mysql->delete_pdo('ed_construcao',"`id` = {$edificios_construcao->id}");
				endif;
			endforeach;
		}

	}

?>
