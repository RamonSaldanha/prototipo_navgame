<?php

if(isset($_POST['autenticar'])):
  $aldeia->tempoColheitaAtt($_SESSION['aid'],$_POST['tipo_de_recurso']);
endif;

$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar["temp_colheita"] - time();
if($tempo < 0):
  echo "colheita ja foi finalizada";
  echo "<form action=\"\" method=\"POST\">";
  echo "<select name=\"tipo_de_recurso\">";
  foreach($colheita_data as $plantar):
    echo "<option value=\"{$plantar['colheita_nome']}\">{$plantar['colheita_nome']}</option>";
  endforeach;
  echo "</select><input type=\"submit\" name=\"autenticar\" /></form>";
else:
  echo $construcoes->checarTempoRestante($tempo);
endif;
?>
