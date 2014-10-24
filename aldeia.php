<?php
require("engine/autoload.php");
$sessao = new sessao();
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();
$aldeia = new aldeia();
// FUNÇÕES QUE PRECISAM SER EXECUTADOS SEMPRE QUE VOCÊ ATUALIZAR A PÁGINA
$automatico = new automatico();
$aldeia->recursosAtt($_SESSION["aid"]);
$automatico->ultima_checagemAtt($_SESSION["uid"]);
$automatico->terminarConstrucao($_SESSION["aid"]);



// CONSTRUÇÕES EM ANDAMENTO
foreach($pdo_mysql->select_pdo("ed_construcao","`aid` = {$_SESSION['aid']}") as $edificios_construcao):
	$edificio_prop = $construcoes->checarPropEdificio("{$edificios_construcao->edificio_tipo}");
	echo "<br /> <b>edificio em construção:</b> ". $edificio_prop["edificio_nome"]. " ficará pronto às ";
	$tempo_restante = ($edificio_prop["tempo_construcao"]) - time();
	echo $construcoes->checarTempoRestante($edificios_construcao->tempo_construcao-time());
endforeach;
print_r($aldeia->calcularProd({$_SESSION["aid"]});
?>
<div style="width: 255px;">
<?php
// CONSTRUÇÕES DA ALDEIA
for($t=1;$t <= 9;$t++)
{
	$terreno = "t" . $t;
	foreach ($pdo_mysql->select_pdo("edificios","`aid` = {$_SESSION['aid']}") as $edificios):
		echo "<a title='' href='construir.php?t={$t}' ><img src='img/e{$edificios->$terreno}.png' style='float: left;margin: 0;padding:0;'  ></a>";
	endforeach;
}
?>
</div>
