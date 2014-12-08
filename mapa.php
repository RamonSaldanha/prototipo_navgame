<?php
include("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
$aldeia = new aldeia();
$construcoes = new construcoes();
include("modelos/menu.tpl");
include("modelos/menu_recursos.tpl");
?>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<div id="mapa_div" style="width: 420px; height: 420px;">
</div>

<script type="text/javascript">
$( "#mapa_div" ).load( "mapa.data.php" );
</script>

