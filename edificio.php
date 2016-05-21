
<html>

	<head>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
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
		<?php include_once("modelos/head_jquery.tpl");?>
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

		?>
		<div id="tabs">
		<?php
		include_once("modelos/tabs.tpl");
		?>
		</div>
		<div>
			<?php
			echo "<img src=\"modelo_grafico/img/e_p{$_GET['ed']}.png\" height=\"150\" width=\"150\" align=\"left\" />";
			include("modelos/construcoes/{$_GET['ed']}.tpl");
			?>
		</div>
	</body>
</html>