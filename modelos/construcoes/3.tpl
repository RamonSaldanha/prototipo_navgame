<?php
$checar_ed = $construcoes->checarPropEdificio($_GET['ed']);
echo "<b>{$checar_ed['edificio_nome']}</b><br />";
?>

<?php
$colheita = new colheita();

// recebe a informação da colheita, transmitida pelo formulário
// e executa a função pra a colheita entrar em processo
if(isset($_POST['autenticar'])):
  $colheita->tempoColheitaAtt($_SESSION['aid'],$_POST['tipo_de_recurso']);
endif;

// após o termino da colheita, ele imprime na tela o link de coleta
// feito isso, ele irá executar a função


// aqui ele verifica o tempo de colheita pra saber se a colheita já está
// pronta ou não, e se estiver pronta imprime o link de receber colheita.
$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar["temp_colheita"] - time();

if($aldeia_checar["tipo_colheita"] != "" && $tempo < 1):
  // tudo que for ligado ao deficit de colheita, tem que ficar dentro desse if
  // porque se não ele vai verificar a propriedade de uma colheita que não existe e a conta vai dividir por zero, gerando um erro
  $colheita_deficit_prop = $colheita->percaDeColheita($_SESSION['aid'],$aldeia_checar["tipo_colheita"]);

  if(isset($_GET['coletar'])):
    $colheita->colheitaRecolher($_SESSION['aid'],$colheita_deficit_prop["colheita_perdida"]);
  endif;

  echo "sua colheita está pronta a: " . $construcoes->checarTempoRestante(-$colheita_deficit_prop['tempo_perdido']) ." você perdeu equivalente a: " . round($colheita_deficit_prop["porcentagem_perdida"]) . "% / " . round($colheita_deficit_prop["colheita_perdida"]) . " da sua colheita total <br />";
  echo "<a href=\"?ed={$_GET['ed']}&coletar=1\">Receber Colheita</a>";

endif;

unset($aldeia_checar);
// fim da colheita finalizada.

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
