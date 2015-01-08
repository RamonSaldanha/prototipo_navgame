<?php
	class pesquisa
	{
		public function ultima_checagemAtt($aid)
		{
			global $pdo_mysql;
			$ult_att = time();
			$pdo_mysql->update_pdo("aldeia","ult_att = $ult_att","`id` = {$aid}");
		}

	}

?>
