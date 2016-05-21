<?php
if(isset($_GET['mudar_aldeia'])):
  $aldeia->multiAldeias($_SESSION['uid'],$_GET['mudar_aldeia']);
endif;
echo "<ul>";
foreach($aldeia->multiAldeias($_SESSION['uid']) as $multi_aldeias):
  echo "<li><a href=\"?mudar_aldeia={$multi_aldeias->id}\"". ">" . $multi_aldeias->aldeia_nome . "</a> | </li>";
endforeach;
echo "</ul>";
?>
