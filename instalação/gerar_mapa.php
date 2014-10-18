<?php
include("pdo_mysql.class.php");

for($x=0;$x <= 20;$x++)
{
	for($y=0;$y <=20;$y++)
	{	
		$tipo = rand(1,3);
		$database->insert_pdo('`mapa`',"(`id`, `x`, `y`, `tip`, `subtip`) VALUES (NULL, '{$x}', '{$y}', '$tipo', '$tipo');");
	}
}

?>
