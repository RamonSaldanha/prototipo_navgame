<?php

if(isset($_POST['autenticar'])):
  $aldeia->tempoColheitaAtt($_SESSION['aid'],$_POST['tipo_de_recurso']);
endif;

$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");
$tempo = $aldeia_checar["temp_colheita"] - time();
echo $construcoes->checarTempoRestante($tempo);

?>
<form action="" method="POST">

<select name="tipo_de_recurso">
<?php
foreach($colheita_data as $plantar):
?>
  <option value="<?=$plantar['colheita_nome']?>"><?=$plantar['colheita_nome']?></option>
<?php
endforeach;
?>
</select>
<input type="submit" name="autenticar" />
</form>
