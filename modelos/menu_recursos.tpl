<div>
<?php
$recursos = $aldeia->calcularProdEstoque($_SESSION['aid']);
echo "Madeira (<font size=\"2\">produção</font> " . $recursos[0]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[0]["estoque"] .") - ";
echo "Pedra (<font size=\"2\">produção</font> " . $recursos[1]["producao"] . " <font size=\"2\">estoque</font> " . $recursos[1]["estoque"] .") ";
echo "Comida (<font size=\"2\">estoque</font> " . $recursos[2]["estoque"] .") / ";
echo "<font size=\"2\">limite de estoque </font>" . $aldeia->checarArmazem($_SESSION['aid']) . " - ";


// foreach($aldeia->calcularProdEstoque($_SESSION['aid']) as $recursos_menu):
//   echo "(" . $recursos_menu['recurso_nome'] . " por hora " . $recursos_menu['producao'] ."/" . $recursos_menu['estoque'] . ") ";
// endforeach;
// echo "/" . $aldeia->checarArmazem($_SESSION['aid']);
?><br />
