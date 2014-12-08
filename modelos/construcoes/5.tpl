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
<br />
<?php 
if(!isset($_GET['pesq'])):
	echo "aqui ficará todos as pesquisas em processo </br>";
endif;
if(isset($_GET['addNivel'])):
	echo "adiciona nível aqui nessa merda porra";
endif;

if(isset($_GET['pesq'])):
	$array = $$_GET['pesq'];
	for($nivel = 1; $nivel <= count($array); $nivel++):
		// printa todos as hierarquias da pesquisa_data...
		$pesquisas = $pdo_mysql->select_pdo_where("pesquisa","`uid` = {$_SESSION['uid']}");
		$nome_tabela = $_GET['pesq'] . $nivel;
		echo $array[$nivel]['nome_pesquisa'] . "<br />";
		for($sub_nivel = 1; $sub_nivel <= (count($array[$nivel])-1); $sub_nivel++):
			if($pesquisas[$nome_tabela] + 1 < $sub_nivel):
				echo "<strike><a href=\"?ed=5&addNivel={$nome_tabela}\">Nível".$sub_nivel." custo de ouro: ".$array[$nivel][$sub_nivel]['custo_ouro'] ."</a><br /></strike>";
			elseif($pesquisas[$nome_tabela] >= $sub_nivel):
				echo "<a href=\"?ed=5&addNivel={$nome_tabela}\">Nível".$sub_nivel." custo de ouro: ".$array[$nivel][$sub_nivel]['custo_ouro'] ."</a> (você já pesquisou isso.)<br />";
			else:
				echo "<a href=\"?ed=5&addNivel={$nome_tabela}\">Nível".$sub_nivel." custo de ouro: ".$array[$nivel][$sub_nivel]['custo_ouro'] ."</a><br />";
			endif;
		endfor;
	endfor;
endif;
?>