<?php
// area de inclusao de propriedades importantes
include_once("data/edificios_data.php");
include_once("data/recursos_data.php");
include_once("data/colheita_data.php");
include_once("data/pesquisa_data.php");
include_once("data/unidade_data.php");
include_once("data/edificio_tecnica_data.php");
// include_once("modelos/menu.tpl");

include_once("engine/configuracoes.php");
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Brazil/East");

		function __autoload($classe)
		{
			if(file_exists('engine/' . $classe . '.php')):
				require_once('engine/' . $classe . '.php');
			else:
				exit('O arquivo ' . $file . ' n�o foi encontrado!');
			endif;
		}

?>
