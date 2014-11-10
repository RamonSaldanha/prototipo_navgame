<?php
$colheita = new colheita();

// recebe a informação da colheita, transmitida pelo formulário
// e executa a função pra a colheita entrar em processo
if(isset($_POST['autenticar'])):
  $colheita->tempoColheitaAtt($_SESSION['aid'],$_POST['tipo_de_recurso']);
endif;

// após o termino da colheita, ele imprime na tela o link de coleta
// feito isso, ele irá executar a função
if(isset($_GET['coletar'])):
  $colheita->colheitaRecolher($_SESSION['aid']);
endif;

// aqui ele verifica o tempo de colheita pra saber se a colheita já está
// pronta ou não, e se estiver pronta imprime o link de receber colheita.
$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar["temp_colheita"] - time();

if($aldeia_checar["tipo_colheita"] != "" && $tempo < 0):
    $tempo_perdido = -$colheita->percaDeColheita($_SESSION['aid'],$aldeia_checar["tipo_colheita"])["tempo_perdido"];
    echo "sua colheita está pronta a: " . $construcoes->checarTempoRestante($tempo_perdido) ." você perdeu equivalente a: " . $colheita->percaDeColheita($_SESSION['aid'],$aldeia_checar["tipo_colheita"])["colheita_perdida"] . " da sua colheita total <br />";
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
