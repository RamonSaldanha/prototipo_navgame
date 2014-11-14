<?php
require("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();
$aldeia = new aldeia();
$sessao = new sessao();

include("modelos/menu.tpl");
include("modelos/menu_recursos.tpl");

echo "<img src=\"modelo_grafico/img/e_p{$_GET['ed']}.png\" height=\"150\" width=\"150\" align=\"left\" />";
include("modelos/construcoes/{$_GET['ed']}.tpl");
?>
