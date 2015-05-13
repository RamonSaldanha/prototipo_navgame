<?php
// evoluir tecnicas de construcao
  for($nivel = 1; $nivel <= count($edificio_tecnica[$_GET['ed']]); $nivel++):
  	echo "<img title='Melhoria nível {$nivel} => {$edificio_tecnica[$_GET['ed']][$nivel]['nome_subpesq']}' src='modelo_grafico/img/evoluir.jpg' style='float:left;' />";
  endfor;

?>