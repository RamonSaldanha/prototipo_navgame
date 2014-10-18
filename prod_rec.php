forma 1 (sem while) (id 1): <br/>
--------------------------- <br />
<?php
	require("engine/autoload.php");
	$pdo_mysql = new pdo_mysql();
	$aldeia = $pdo_mysql->select_pdo_where("aldeia","`id` = 1");
	echo "<b>sua producao por hora:</b> {$aldeia["producao"]} <b>Seu armazem: </b>" . round($aldeia["armazem"]) ;
?>
<br /><br />
forma 2 (com while):<br />
--------------------------- <br />
<?php

	foreach ($pdo_mysql->select_pdo('aldeia') as $linha):
		$recurso = ($linha->producao / 3600) * (time() - $linha->ult_att);
		$pdo_mysql->update_pdo('aldeia',"armazem = armazem + $recurso","`id` = $linha->id");
		echo "<b>producao do id {$linha->id}:</b> {$linha->producao} <b>Seu armazem: </b>" . round($linha->armazem)."<br />";
	endforeach;	
	
	$ult_att = time();
	$pdo_mysql->update_pdo("aldeia","ult_att = $ult_att");
	
?>