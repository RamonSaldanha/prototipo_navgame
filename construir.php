<?php
$terreno = $_GET['t'];

require("engine/autoload.php");
$sessao = new sessao();
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();


if(!empty($_GET['e'])):
	$edificio = "e_" . $_GET['e'];
	$construcoes->construir($terreno,$edificio);
endif;
?>


<div style="border: 1px #ccc solid;">
	<div style="border-bottom: 1px #ccc solid;">Conjunto Habitacional</div>
	<div >Fornece mão de obra a sua aldeia, com o conjuto, você pode aumentar sua população Óciosa</div>
	<div >Custos: Madeira(500) <a href="?t=<?php echo $terreno; ?>&e=1" >Construir</a></div>
</div>
