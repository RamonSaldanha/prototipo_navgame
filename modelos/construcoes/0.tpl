<?php
$checar_ed = $construcoes->checarPropEdificio($_GET['ed']);
echo "<b>{$checar_ed['edificio_nome']}</b><br />";
?>

<?php

$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar['temp_pop_ociosa'] - time();

if(isset($_GET['acolher'])):
  // se voce tiver espaço no conjunto habitacional, você vai receber a população que está aguardando aprovação
  if($unidades_checar['u1'] <= $aldeia->checarLimiteHabitacional($_SESSION['aid'])):
    $aldeia->receberBeneficio($_SESSION['aid'],'unidades','u1',$aldeia->calcularRecPopulacao($_SESSION['aid']));
    $aldeia->tempoBeneficioAtt($_SESSION['aid'],"pop_ociosa",TEMPO_POPULACAO);
    header("Location: aldeia.php?ed=0");
  else:
    echo "seu conjunto habitacional, já está lotado";
  endif;
endif;

$unidades_checar = $pdo_mysql->select_pdo_where("unidades","`aid` = {$_SESSION['aid']}");

if($tempo < 0):
  if($unidades_checar['u1'] <= $aldeia->checarLimiteHabitacional($_SESSION['aid'])):
    echo "<a href=\"?ed=0&acolher=1\">Acolher população óciosa</a>";
  else:
     echo "seu conjunto habitacional, já está lotado";
   endif;
else:
  echo $construcoes->checarTempoRestante($tempo) . " pra chegada de gente pronta pro trabalho";
endif;

unset($aldeia_checar);
?>