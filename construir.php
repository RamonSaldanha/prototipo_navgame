<?php
require("engine/autoload.php");
$sessao = new sessao();
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();


if(isset($_GET['e']) && $_GET['e'] >= '0'):
	$construcoes->construir($_GET['t'],$_GET['e']);
endif;
foreach($edificios_data as $edificio):
	echo "<div style=\"border: 1px #ccc solid;\">";
	echo "<div style=\"border-bottom: 1px #ccc solid;\">{$edificio["edificio_nome"]}</div>";
	echo "<div>{$edificio["edificio_descricao"]}</div>";
	echo "<div >Custos: Madeira({$edificio["custo_madeira"]}) <a href=\"?t={$_GET['t']}&e={$edificio["id"]}\" >Construir</a></div>";
	echo "</div><br />";
endforeach;
?>
