<?php
$colheita = new colheita();

if(isset($_POST['autenticar'])):
  $colheita->tempoColheitaAtt($_SESSION['aid'],$_POST['tipo_de_recurso']);
endif;

if(isset($_GET['coletar'])):
  $colheita->colheitaRecolher($_SESSION['aid']);
  echo "coletou";
endif;

$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar["temp_colheita"] - time();

if($aldeia_checar["tipo_colheita"] != "" && $tempo < 0):
    echo "<a href=\"?ed={$_GET['ed']}&coletar=1\">Receber Colheita</a>";
endif;

if($tempo < 0):
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
