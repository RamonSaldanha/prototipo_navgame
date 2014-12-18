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
		$automatico->terminarConstrucao($_SESSION["aid"]);
		include("modelos/menu.tpl");
		?>
		<div id="recursos"></div>
		<?php 
		// UNIDADES NA ALDEIA
		$checar_unidades = $pdo_mysql->select_pdo_where("unidades","`aid` = {$_SESSION['aid']}");
		foreach($unidade_data as $propriedade => $valor):
		 	$unidade_id = "u" . $propriedade;
		 	if($checar_unidades["{$unidade_id}"] > 0):
		 		echo $valor['unidade_nome'] .": " . $checar_unidades["{$unidade_id}"] .  " | ";
		 	endif;
		endforeach;
		unset($checar_unidades);
		?>
		<div>
			<?php
			// CONSTRUÇÕES EM ANDAMENTO
			foreach($pdo_mysql->select_pdo("ed_construcao","`aid` = {$_SESSION['aid']}") as $edificios_construcao):
				$edificio_prop = $construcoes->checarPropEdificio("{$edificios_construcao->edificio_tipo}");
				echo "<br /> <b>edificio em construção:</b> ". $edificio_prop["edificio_nome"]. " ficará pronto às ";
				$tempo_restante = ($edificio_prop["tempo_construcao"]) - time();
				echo $construcoes->checarTempoRestante($edificios_construcao->tempo_construcao-time());
			endforeach;
			?>
		</div>
 		<div style="width: 255px;">
			<?php
			// CONSTRUÇÕES DA ALDEIA
			for($t=1;$t <= 9;$t++)
			{
				$terreno = "t" . $t;
				foreach ($pdo_mysql->select_pdo("edificios","`aid` = {$_SESSION['aid']}") as $edificios):
					if($edificios->$terreno != ""):
						echo "<a title='' href='edificio.php?ed={$edificios->$terreno}' ><img src='modelo_grafico/img/e{$edificios->$terreno}.png' style='float: left;margin: 0;padding:0;'  ></a>";
					else:
						echo "<a title='' href='construir.php?t={$t}' ><img src='modelo_grafico/img/e{$edificios->$terreno}.png' style='float: left;margin: 0;padding:0;'  ></a>";
					endif;
				endforeach;
			}
			include("modelos/multialdeias.tpl");
			?>
		</div>
	</body>
</html>