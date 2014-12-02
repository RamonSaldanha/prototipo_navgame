<?php
include("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
?>
<script type="text/javascript" src="mapa.js"></script>
<link rel="stylesheet" type="text/css" href="layout.style.css">
<div id="conteudo" style="width: 420px; background-color: #b5e61d; height: 420px;">
<?php
if(isset($_GET['x1'])):
	$x1 = 0 + $_GET['x1'];
else:
	$x1 = 0;
endif;
if(!empty($_GET['y1'])):
	$y1 = 0 + $_GET['y1'];
else:
	$y1 = 0;
endif;

for($x=0 + $x1;$x <= 6 + $x1;$x++)
{
	for($y=0 + $y1;$y <= 6 + $y1;$y++)
	{
		foreach ($pdo_mysql->select_pdo("mapa","`x` LIKE $x AND `y` LIKE $y") as $mapa):
	      if($mapa->aid != ""):
	                    echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='modelo_grafico/img/m4.png' style='float: left;margin: 0;padding:0;'  ></a>";
	      else:
	        switch($mapa->tip){
	          case 1:
	            echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='modelo_grafico/img/m1.png' style='float: left;margin: 0;padding:0;'  ></a>";
	          break;
	          case 2:
	            echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='modelo_grafico/img/m2.png' style='float: left;margin: 0;padding:0;'  ></a>";
	          break;
	          case 3:
	            echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='modelo_grafico/img/m3.png' style='float: left;margin: 0;padding:0;'  ></a>";
	          break;
	        }
	      endif;
		endforeach;
	}
}

?>
</div>
<a href="?x1=<?php echo $x1 + 1; ?>">descer</a> | <a href="?x1=<?php echo $x1 - 1; ?>">subir</a> | <a href="?y1=<?php echo $y1 - 1; ?>">esquerda</a> | <a href="?y1=<?php echo $y1 + 1; ?>">direita</a>
<input id="txtnome" name="txtnome" type="hidden" value="<?php echo $x1; ?>" />
<button onclick="moverX('+1')">descer</button>
<button onclick="moverX('-1')">subir</button>