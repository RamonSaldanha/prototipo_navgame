<?php

	class automatico
	{


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
				global $construcoes;

					if($edificios_construcao->tempo_construcao < time()):
						if($construcoes->checarSeExisteEd($_SESSION['aid'],$edificios_construcao->edificio_tipo) != "existe"):
							$pdo_mysql->update_pdo('edificios',"`{$edificios_construcao->terreno}` = \"{$edificios_construcao->edificio_tipo}\"","`aid` = {$aldeia_id}");
						endif;
						$pdo_mysql->delete_pdo('ed_construcao',"`id` = {$edificios_construcao->id}");
					endif;
			endforeach;
		}

	}

?>
