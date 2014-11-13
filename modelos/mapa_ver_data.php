<style>
a:link {
  cursor: move;
}
</style>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function() {
  $( "#div_map" ).draggable();
});
</script>

<link rel="stylesheet" type="text/css" href="layout.style.css">
<div id="div_map" style="width: 2400px; height: 2400px;">
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
for($x=0 + $x1;$x <= 40 + $x1;$x++)
{
  for($y=0 + $y1;$y <= 39 + $y1;$y++)
  {
    foreach ($pdo_mysql->select_pdo("mapa","`x` LIKE $x AND `y` LIKE $y") as $mapa):
      switch($mapa->tip){
        case 1:
          echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='img/m1.png' style='float: left;margin: 0;padding:0;'  ></a>";
        break;
        case 2:
          echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='img/m2.png' style='float: left;margin: 0;padding:0;'  ></a>";
        break;
        case 3:
          echo "<a class='map' name='{$mapa->x};{$mapa->y}' title='{$mapa->x} | {$mapa->y}' href='#{$mapa->x};{$mapa->y}' ><img src='img/m3.png' style='float: left;margin: 0;padding:0;'  ></a>";
        break;
      }
    endforeach;
  }
}
?>
</div>
