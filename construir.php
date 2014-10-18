<?php
$terreno = $_GET['t'];

require("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();

if(!empty($_GET['e'])):
	$edificio = $_GET['e'];
	$aldeia = 1;
	$construcoes->construir($terreno,$edificio,$aldeia);
endif;
?>
<div style="border: 1px #ccc solid;">
	<div style="border-bottom: 1px #ccc solid;">Conjunto Habitacional</div>
	<div >Fornece mão de obra a sua aldeia, com o conjuto, você pode aumentar sua população óciosa</div>
	<div >Custos: Madeira(500) <a href="?t=<?php echo $terreno; ?>&e=1" >Construir</a></div>
</div>