<?php
foreach($aldeia->calcularProd($_SESSION["aid"]) as $recursos_prop):
  echo "<u>" . $recursos_prop["recurso_nome"] . " por hora:</u> " . $recursos_prop["producao"] . " ";
endforeach;
?>
