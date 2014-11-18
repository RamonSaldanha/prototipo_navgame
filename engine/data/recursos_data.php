<?php
$recursos_data = array(
	array(
		"id" => "0",
		"recurso_nome" => "madeira",
		"producao" => "%produz%",
		"estoque" => "%estocado%"
	),
	array(
		"id" => "1",
		"recurso_nome" => "pedra",
		"producao" => "%produz%",
		"estoque" => "%estocado%"
	),
	array(
		"id" => "2",
		"recurso_nome" => "comida",
		"producao" => "%produz%",
		"estoque" => "%estocado%"
	),
	//aqui é diferente, porque nesse caso é um recursos adicional com tratamento especial...
	array(
		"id" => "3",
		"recurso_nome" => "pop_ociosa",
		"producao" => "",
		"estoque" => "",
		"ociosa" => "%ociosa%",
		"ocupada" => "%ocupada%"
	)
);

?>
