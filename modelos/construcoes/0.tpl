<?php

$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar['temp_pop_ociosa'] - time();

if(isset($_GET['acolher'])):
  // se voce tiver espaço no conjunto habitacional, você vai receber a população que está aguardando aprovação
  if(($aldeia_checar['pop_ociosa'] + $aldeia_checar['pop_ocupada']) < $aldeia->checarLimiteHabitacional($_SESSION['aid'])):
    $aldeia->receberBeneficio($_SESSION['aid'],'pop_ociosa',$aldeia->calcularRecPopulacao($_SESSION['aid']));
    $aldeia->tempoBeneficioAtt($_SESSION['aid'],"pop_ociosa",TEMPO_POPULACAO);
  else:
    echo "seu conjunto habitacional, já está lotado";
  endif;
endif;

if($tempo < 0):
  if(($aldeia_checar['pop_ociosa'] + $aldeia_checar['pop_ocupada']) < $aldeia->checarLimiteHabitacional($_SESSION['aid'])):
    echo "<a href=\"?ed=0&acolher=1\">Acolher população óciosa</a>";
  else:
     echo "seu conjunto habitacional, já está lotado";
   endif;
else:
  echo $construcoes->checarTempoRestante($tempo) . " pra chegada de gente pronta pro trabalho";
endif;
?>