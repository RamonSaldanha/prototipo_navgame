<?php

if(isset($_POST['autenticar'])):
  $aldeia->tempoRecursoAtt($_SESSION['aid'],"comida", $_POST['tempo_de_coleta']);
endif;

$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar["temp_comida"] - time();
echo $construcoes->checarTempoRestante($tempo);

?>
<form action="" method="POST">
<select name="tempo_de_coleta">
  <option value="1hrs">Uma Hora</option>
  <option value="2hrs">Duas Horas</option>
  <option value="4hrs">Quatro Horas</option>
  <option value="6hrs">Seis Horas</option>
</select>
<input type="submit" name="autenticar" />
</form>
