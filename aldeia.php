<!doctype html>
<html>
<head>
<title>Aldeia</title>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
$( "#tabs" ).tabs();
});
</script>
<script type="text/javascript">
	function getContent( timestamp )
	{
		var queryString = { 'timestamp' : timestamp };
	 
		$.get ('longPollingServer.php' , queryString , function ( data )
		{
			var obj = jQuery.parseJSON( data );
			$( '#recursos' ).html( obj.content );
	 
			// reconecta ao receber uma resposta do servidor
			getContent( obj.timestamp );
		});
	}
	 
	$( document ).ready ( function ()
	{
		getContent();
	});
</script>
<link rel="stylesheet" href="modelo_grafico/css/aldeia.css">
</head>
<body>
<?php
require("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
$construcoes = new construcoes();
$automatico = new automatico();
$aldeia = new aldeia();

// FUNÇÕES QUE PRECISAM SER EXECUTADOS SEMPRE QUE VOCÊ ATUALIZAR A PÁGINA
$automatico->terminarConstrucao($_SESSION["aid"]);
$automatico->terminarPesquisas($_SESSION["uid"]);
?>
<div id="tabs">
<?php
include_once("modelos/tabs.tpl");
?>
</div>
<?php
	// CONSTRUÇÕES DA ALDEIA
	for($t=1;$t <= 9;$t++)
	{
		$terreno = "t" . $t;
		foreach ($pdo_mysql->select_pdo("edificios","`aid` = {$_SESSION['aid']}") as $edificios):
			if($edificios->$terreno != ""):
				echo "<a title='' href='edificio.php?ed={$edificios->$terreno}' ><img id='{$terreno}' class='borda_construcao' title='{$terreno}' src='modelo_grafico/img/e{$edificios->$terreno}.png' style='float: left;margin: 0;padding:0;'  ></a>";
			else:
				echo "<a title='' href='construir.php?t={$t}' ><img id='{$terreno}' class='borda_construcao' title='$terreno' src='modelo_grafico/img/e{$edificios->$terreno}.png'></a>";
			endif;
		endforeach;
	}
?>

</body>
</html>
