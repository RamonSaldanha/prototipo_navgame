<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="homeycombs/css/homeycombs.css" />
<script type="text/javascript" src="mapa_hex.ajax.js"></script>
<?php
include("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$sessao = new sessao();
?>
<div class="honeycombs" id="mapa">

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

for($x=0 + $x1;$x <= 7 + $x1;$x++)
{
    for($y=0 + $y1;$y <= 7 + $y1;$y++)
    {
        foreach ($pdo_mysql->select_pdo("mapa","`x` LIKE $x AND `y` LIKE $y") as $mapa):
          if($mapa->aid != ""):
                        echo "<div class='comb'><img src='modelo_grafico/img/m4.png' /><span>{$mapa->x}|{$mapa->y}</span></div>";
          else:
            switch($mapa->tip){
              case 1:
                echo "<div class='comb'><img src='modelo_grafico/img/m1.png' /><span>{$mapa->x}|{$mapa->y}</span></div>";
              break;
              case 2:
                echo "<div class='comb'><img src='modelo_grafico/img/m2.png' /><span>{$mapa->x}|{$mapa->y}</span></div>";
              break;
              case 3:
                echo "<div class='comb'><img src='modelo_grafico/img/m3.png' /><span>{$mapa->x}|{$mapa->y}</span></div>";
              break;
            }
          endif;
        endforeach;
    }
}

?>

</div>
<input id="coordenadaX" name="coordenadaX" type="hidden" value="<?php echo $x1; ?>" />
<input id="coordenadaY" name="coordenadaY" type="hidden" value="<?php echo $y1; ?>" />
<button onclick="moverX('+1')">descer</button>
<button onclick="moverX('-1')">subir</button>
<button onclick="moverY('+1')">Direita</button>
<button onclick="moverY('-1')">Esquerda</button>

