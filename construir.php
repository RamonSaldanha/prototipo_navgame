<?php
require("engine/autoload.php");
$sessao = new sessao();
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();


if(isset($_GET['e']) && $_GET['e'] >= '0'):
	$construcoes->construir($_GET['t'],$_GET['e'],$_SESSION['aid']);
endif;

foreach($edificios_data as $edificio):
		echo "<div style=\"border: 1px #ccc solid;\">";
		echo "<div style=\"float:left; height:55x; width:65px;\"><img src='img/e{$edificio["id"]}.png' height='55px' width='55px' style='float: left;margin: 0;padding:0;'  ></div>";
		echo "<div style=\"border-bottom: 1px #ccc solid;\">{$edificio["edificio_nome"]}</div>";
		echo "<div>{$edificio["edificio_descricao"]}</div>";
		if($construcoes->checarSeExisteEd($_SESSION['aid'],$edificio["id"],"t" . $_GET['t']) != ""):
			echo "Já existe essa construção";
		else:
			echo "<div >Custos: Madeira({$edificio["custo_madeira"]}) <a href=\"?t={$_GET['t']}&e={$edificio["id"]}\" >Construir</a></div>";
		endif;
		echo "</div><br />";
endforeach;
?>
