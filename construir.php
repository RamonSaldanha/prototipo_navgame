<?php
$terreno = $_GET['t'];

require("engine/autoload.php");
$pdo_mysql = new pdo_mysql();
$construcoes = new construcoes();
$sessao = new sessao();

if(!empty($_GET['e'])):
	$edificio = $_GET['e'];
	$aldeia = 1;
	$construcoes->construir($terreno,$edificio,$aldeia);
endif;

?>
<div style="border: 1px #ccc solid;">
	<div style="border-bottom: 1px #ccc solid;">Conjunto Habitacional</div>
	<div >Fornece m�o de obra a sua aldeia, com o conjuto, voc� pode aumentar sua popula��o �ciosa</div>
	<div >Custos: Madeira(500) <a href="?t=<?php echo $terreno; ?>&e=1" >Construir</a></div>
</div>
