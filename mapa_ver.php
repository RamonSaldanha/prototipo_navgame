<?php
include("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
include("modelos/menu.tpl");
include("modelos/menu_recursos.tpl");
?>
<div style="overflow: auto; width: 500px; height: 500px; overflow-y:hidden; overflow-x:hidden;url(img/e.png);"><?php include("modelos/mapa_ver_data.php"); ?></div>
