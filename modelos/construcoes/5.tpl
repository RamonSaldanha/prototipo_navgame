<?php
$checar_ed = $construcoes->checarPropEdificio($_GET['ed']);
echo "<b>{$checar_ed['edificio_nome']}</b><br />";
?>
<script>
function mudarEndereco() 
{
	var selectPegar = document.getElementById('selecionar');
	window.location = selectPegar.value;
}
</script>

<select id="selecionar" onchange="mudarEndereco();">
	<option value="" ></option>
	<option value="edificio.php?ed=5&pesq=militar_pesq" <?php if(isset($_GET['pesq']) AND $_GET['pesq'] == "militar_pesq"): echo "selected = 'selected'"; endif;?>>Militar</option>
	<option value="edificio.php?ed=5&pesq=rec_pesq" <?php if(isset($_GET['pesq']) AND $_GET['pesq'] == "rec_pesq"): echo "selected = 'selected'"; endif; ?>>Produtividade</option>
	<option value="edificio.php?ed=5&pesq=economia_pesq" <?php if(isset($_GET['pesq']) AND $_GET['pesq'] == "economia_pesq"): echo "selected = 'selected'"; endif; ?>>Economia</option>
</select>

<?php 
	if(isset($_GET['pesq'])):
		print_r($$_GET['pesq']);
	endif;
?>