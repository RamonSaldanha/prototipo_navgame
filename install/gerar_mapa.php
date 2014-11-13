<?php
require("autoload.php");
$pdo_mysql = new pdo_mysql();

for($x=0;$x <= 100;$x++)
{
	for($y=0;$y <=100;$y++)
	{
		$tipo = rand(1,3);
		$pdo_mysql->insert_pdo('`mapa`',"(`id`, `x`, `y`, `tip`, `subtip`) VALUES (NULL, '{$x}', '{$y}', '$tipo', '$tipo');");
	}
}

?>
