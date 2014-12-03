<?php
include("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
$aldeia = new aldeia();
$construcoes = new construcoes();
include("modelos/menu.tpl");
include("modelos/menu_recursos.tpl");
?>

<script type="text/javascript" src="mapa.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" type="text/css" href="layout.style.css">

<div id="mapa_div" style="width: 420px; background-color: #b5e61d; height: 420px;">
</div>
<script type="text/javascript">
$( "#mapa_div" ).load( "mapa.data.php" );
</script>