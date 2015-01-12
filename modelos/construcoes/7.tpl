<?php
$checar_ed = $construcoes->checarPropEdificio($_GET['ed']);
echo "<b>{$checar_ed['edificio_nome']}</b><br />";

echo "<b>Benefícios de pesquisas:</b><br />";
$aldeia->verificarPesquisas($_SESSION['uid']);
?>
