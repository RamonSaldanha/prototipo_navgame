<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="mapa.php">mapa</a> | <a href="aldeia.php">aldeia</a> | <a href="sair.php">sair</a> <br />
<?php
date_default_timezone_set("Brazil/East");
require("engine/autoload.php");
$sessao = new sessao();
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();
$automatico = new automatico();
$automatico->recursosAtt($_SESSION["uid"]);
$automatico->ultima_checagemAtt($_SESSION["uid"]);
$automatico->terminarConstrucao($_SESSION["aid"]);


foreach($pdo_mysql->select_pdo("ed_construcao","`aid` = {$_SESSION['aid']}") as $edificios_construcao):
	$edificio_prop = $construcoes->checarPropEdificio("{$edificios_construcao->edificio_tipo}");
	echo "<br /> <b>edificio em construção:</b> ". $edificio_prop["edificio_nome"]. " ficará pronto às ". date("h.i.s", $edificios_construcao->tempo_construcao);
endforeach;

?>
<div style="width: 255px;">
<?php
for($t=1;$t <= 9;$t++)
{
	$terreno = "t" . $t;
	foreach ($pdo_mysql->select_pdo("edificios","`aid` = {$_SESSION['aid']}") as $edificios):
		switch($edificios->$terreno):
			case "0":
				echo "<a title='' href='construir.php?t={$t}' ><img src='img/a1.png' style='float: left;margin: 0;padding:0;'  ></a>";
			break;
			case "e_1":
				echo "<a title='' href='construir.php?t={$t}' ><img src='img/a2.png' style='float: left;margin: 0;padding:0;'  ></a>";
			break;
		endswitch;
	endforeach;
}
?>
</div>
