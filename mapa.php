<?php
include("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
?>

<link rel="stylesheet" type="text/css" href="layout.style.css">
<div style="width: 420px; background-color: #b5e61d; height: 420px;">
<?php
if(!empty($_GET['x1'])):
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
			switch($mapa->tip){
				case 1:
					echo "<a title='{$mapa->x} | {$mapa->y}' href='#' ><img src='img/m1.png' style='float: left;margin: 0;padding:0;'  ></a>";
				break;
				case 2:
					echo "<a title='{$mapa->x} | {$mapa->y}' href='#' ><img src='img/m2.png' style='float: left;margin: 0;padding:0;'  ></a>";
				break;
				case 3:
					echo "<a title='{$mapa->x} | {$mapa->y}' href='#' ><img src='img/m3.png' style='float: left;margin: 0;padding:0;'  ></a>";
				break;
			}
		endforeach;
	}
}

?>
</div>
<a href="?x1=<?php echo $x1 + 1; ?>">descer</a> | <a href="?x1=<?php echo $x1 - 1; ?>">subir</a> | <a href="?y1=<?php echo $y1 - 1; ?>">esquerda</a> | <a href="?y1=<?php echo $y1 + 1; ?>">direita</a>
