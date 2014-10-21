<?php
// area de inclusao de propriedades importantes
include_once("data/edificios_data.php");

		function __autoload($classe)
		{
			if(file_exists('engine/' . $classe . '.php')):
				require_once('engine/' . $classe . '.php');
			else:
				exit('O arquivo ' . $file . ' n�o foi encontrado!');
			endif;
		}

?>
