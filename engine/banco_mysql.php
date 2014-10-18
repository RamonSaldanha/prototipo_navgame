<?php

define("DB_SERVIDOR","127.0.0.1");
define("DB_USUARIO","root");
define("DB_SENHA","");
define("DB_BANCODEDADOS","jogo");

	class banco_mysql
	{
		
		public function __construct()
		{
			mysql_connect(DB_SERVIDOR,DB_USUARIO,DB_SENHA) or die (mysql_error());
			mysql_select_db(DB_BANCODEDADOS) or die (mysql_error());
		}
		
	}
	
$conexao = new banco_mysql();
?>