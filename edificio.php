<?php
require("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();
$aldeia = new aldeia();
$sessao = new sessao();

echo "<img src=\"img/e_p{$_GET['ed']}.png\" height=\"150\" width=\"150\" align=\"left\" />";
include("modelos/construcoes/{$_GET['ed']}.tpl");
?>
