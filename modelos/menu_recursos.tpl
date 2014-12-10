<div>
<?php
$recursos = $aldeia->calcularProdEstoque($_SESSION['aid']);
$consumo = $aldeia->calcularConsumoPop($_SESSION['aid']);
echo "Madeira (<font size=\"2\">produção</font> " . $recursos[0]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[0]["estoque"] .") - ";
echo "Pedra (<font size=\"2\">produção</font> " . $recursos[1]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[1]["estoque"] .") ";
echo "Água (<font size=\"2\">produção[litro]</font> " . $recursos[3]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[3]["estoque"] .") ";
echo "Comida (<font size=\"2\">consumo</font> " . $consumo['comida'] . " <font size=\"2\">estoque</font> " . $recursos[2]["estoque"] .") / ";
echo "<font size=\"2\">limite de estoque </font>" . $aldeia->checarArmazem($_SESSION['aid']) . " <br />";

$checar_unidades = $pdo_mysql->select_pdo_where("unidades","`aid` = {$_SESSION['aid']}");
foreach($unidade_data as $propriedade => $valor):
 	$unidade_id = "u" . $propriedade;
 	if($checar_unidades["{$unidade_id}"] > 0):
 		echo $valor['unidade_nome'] .": " . $checar_unidades["{$unidade_id}"] .  " | ";
 	endif;
endforeach;
unset($checar_unidades);
?><br />
