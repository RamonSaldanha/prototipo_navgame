<?php

if(!empty($_POST['nome'])):

	require_once("engine/autoload.php");
	$pdo_mysql = new pdo_mysql();
	$sessao = new sessao();
	$sessao->entrar($_POST['nome'],$_POST['senha']);

endif;

?>
<form action="entrar.php" method="post">
  usuario: <input type="text" name="nome"><br>
  senha: <input type="password" name="senha"><br>
  <button type="submit" value="Submit">Entrar</button>
</form>
