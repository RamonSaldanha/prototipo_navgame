
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
		$aldeia->recursosAtt($_SESSION["aid"]);
		include("modelos/menu.tpl");
		?>
		<div id="recursos"></div>
		<div>
			<?php
			echo "<img src=\"modelo_grafico/img/e_p{$_GET['ed']}.png\" height=\"150\" width=\"150\" align=\"left\" />";
			include("modelos/construcoes/{$_GET['ed']}.tpl");
			?>
		</div>
	</body>
</html>