<?php
echo "Suas Aldeias: <br />";

if(isset($_GET['mudar_aldeia'])):
  $aldeia->multiAldeias($_SESSION['uid'],$_GET['mudar_aldeia']);
endif;

foreach($aldeia->multiAldeias($_SESSION['uid']) as $multi_aldeias):
  echo "<a href=\"?mudar_aldeia={$multi_aldeias->id}\"". ">" . $multi_aldeias->aldeia_nome . "</a> <br />";
endforeach;
?>
