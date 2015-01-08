<?php
	class automatico
	{
		public function ultima_checagemAtt($aid)
		{
			global $pdo_mysql;
			$ult_att = time();
			$pdo_mysql->update_pdo("aldeia","ult_att = $ult_att","`id` = {$aid}");
		}

		public function terminarConstrucao($aldeia_id)
		{
			global $pdo_mysql;
			foreach($pdo_mysql->select_pdo("ed_construcao","`aid` = {$aldeia_id}") as $edificios_construcao):
				global $construcoes;

					if($edificios_construcao->tempo_construcao < time()):
						$pdo_mysql->delete_pdo('ed_construcao',"`id` = {$edificios_construcao->id}");

						if($construcoes->checarSeExisteEd($_SESSION['aid'],$edificios_construcao->edificio_tipo,$edificios_construcao->terreno) == ""):
							$pdo_mysql->update_pdo('edificios',"`{$edificios_construcao->terreno}` = \"{$edificios_construcao->edificio_tipo}\"","`aid` = {$aldeia_id}");
						endif;

					endif;
			endforeach;
		}

	}

?>
