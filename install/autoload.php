<?php
// area de inclusao de propriedades importantes

		function __autoload($classe)
		{
			if(file_exists('' . $classe . '.php')):
				require_once('' . $classe . '.php');
			else:
				exit('O arquivo ' . $file . ' n�o foi encontrado!');
			endif;
		}

?>
