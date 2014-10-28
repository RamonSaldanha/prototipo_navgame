<?php
foreach($aldeia->calcularProdEstoque($_SESSION['aid']) as $recursos_menu):
  echo "(" . $recursos_menu['recurso_nome'] . " por hora " . $recursos_menu['producao'] ."/" . $recursos_menu['estoque'] . ") ";
endforeach;
?>
