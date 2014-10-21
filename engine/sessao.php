<?php
	class sessao
	{
		public function __construct()
		{
			// aqui ele vai dar update no timestamp e da session_start(); tamb�m verificar se voc� est� logado
			if (!isset($_SESSION)):
				session_start();
			 //echo $_SESSION['aid'];
			else:
				header("Location: entrar.php");
			endif;

			if(empty($_SESSION['usuario'])):
				header("Location: entrar.php");
			endif;
		}


		public function entrar ($usuario,$senha)
		{
			global $pdo_mysql;
			$verificar = $pdo_mysql->select_pdo_where("usuario","`nome` = '$usuario'");

			if(!empty($verificar["nome"])):
				if($senha == $verificar["senha"]):
					$_SESSION['usuario'] = $verificar["nome"];
					$_SESSION['uid'] = $verificar["id"];
					$checar_aldeia = $pdo_mysql->select_pdo_where("aldeia","`uid` = {$verificar['id']}");
					$_SESSION['aid'] = $checar_aldeia['id'];
					header("Location: aldeia.php");
				else:
					echo "senha incorreta";
				endif;
			else:
				echo "nao existe nenhuma conta com este nome";
			endif;
		}

		public function sair()
		{
			session_destroy();
		}
	}

?>
