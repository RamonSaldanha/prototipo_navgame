<?php

	class construcoes
	{
		public function construir ($terreno,$edificio,$aldeia)
		{
			$terreno = "t" . $terreno;
			global $pdo_mysql;
			$pdo_mysql->update_pdo('edificios',"$terreno = $edificio","`aldeia` = '1'");
			header("Location: aldeia.php");
		}
	}

?>