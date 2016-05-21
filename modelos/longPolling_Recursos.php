<?php
require("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
$construcoes = new construcoes();
$automatico = new automatico();
$aldeia = new aldeia();

$recursos = $aldeia->calcularProdEstoque($_SESSION['aid']);
$consumo = $aldeia->calcularConsumoPop($_SESSION['aid']);
$dados ='';
$dados.= "Madeira (<font size=\"2\">produção</font> " . $recursos[0]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[0]["estoque"] .") - ";
$dados.= "Pedra (<font size=\"2\">produção</font> " . $recursos[1]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[1]["estoque"] .") ";
$dados.= "Água (<font size=\"2\">produção[litro]</font> " . $recursos[3]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[3]["estoque"] .") ";
$dados.= "Comida (<font size=\"2\">consumo</font> " . $consumo['comida'] . " <font size=\"2\">estoque</font> " . $recursos[2]["estoque"] .") / ";
$dados.= "<font size=\"2\">limite de estoque </font>" . $aldeia->checarArmazem($_SESSION['aid']) . " <br />";
$dados.= $construcoes->longPollingTempoConstrucao();
$dados.= $aldeia->recursosAtt($_SESSION["aid"]);
$dados.= $automatico->ultima_checagemAtt($_SESSION["aid"]);
$dados.= $automatico->terminarConstrucao($_SESSION["aid"]);
$dados.= $automatico->terminarPesquisas($_SESSION["uid"]);

return $dados;
?>