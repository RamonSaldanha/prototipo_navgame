<?php
$pdo_mysql = new pdo_mysql();
$consulta = $pdo_mysql->show_tables_name();
echo "<ul id='menu_principal'>";
foreach($consulta as $nome_tabelas):
	echo "<li><a href='admin_489574879.php?subpg={$nome_tabelas}'>" . $nome_tabelas . "</a> | </li>";
endforeach;
echo "</ul>"
?>