<a href="mapa.php">mapa</a> | <a href="aldeia.php">aldeia</a> | <a href="sair.php">sair</a> <br />
<?php
	require("engine/autoload.php");
	$sessao = new sessao();
	$pdo_mysql = new pdo_mysql();
	$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = 1");
	echo "<b>sua producao por hora:</b> {$aldeia["producao"]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
?>
<div style="width: 255px;">
<?php
for($t=1;$t <= 9;$t++)
{
	$terreno = "t" . $t;
	foreach ($pdo_mysql->select_pdo("edificios") as $edificios):
		switch($edificios->$terreno):
			case 0:
				echo "<a title='' href='construir.php?t={$t}' ><img src='img/a1.png' style='float: left;margin: 0;padding:0;'  ></a>";
			break;
			case 1:
				echo "<a title='' href='construir.php?t={$t}' ><img src='img/a2.png' style='float: left;margin: 0;padding:0;'  ></a>";
			break;
		endswitch;
	endforeach;
}
?>
</div>
