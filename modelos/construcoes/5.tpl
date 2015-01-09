<?php
$automatico->terminarPesquisas($_SESSION['uid']);
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


// mostrar todas as pesquisas
if(!isset($_GET['pesq'])):
	$pesq_andamento = $pdo_mysql->select_pdo("pesq_andamento","`uid` = {$_SESSION['uid']}");
	$pesq_select = $pdo_mysql->select_pdo("pesquisa","`uid` = {$_SESSION['uid']}");

	echo "
			<table style=\"text-align:left;\">
			<tr>
			<th>Nome da pesquisa</th>
			<th >Atributo</th>
			<th >Tempo restante</th>
			</tr>
		";
	foreach($pesq_andamento as $pesq_data):
		// echo $pesq_data->pesquisa . "<br />";
		$nivel_pesq = $pesq_select[0]->{$pesq_data->pesquisa . $pesq_data->pesq_tipo} + 1;
		// echo $pesq_data->pesquisa . $pesq_data->pesq_tipo . $nivel_pesq;

		$tempo_restate = $construcoes->checarTempoRestante($pesq_data->tempo_pesquisa - time());
		echo "
			<tr>
			<td>{${$pesq_data->pesquisa}[$pesq_data->pesq_tipo]['nome_pesquisa']}</td>
			<td></td>
			<td>{$tempo_restate}</td>
			</tr>
		";
		// print_r(${$pesq_data->pesquisa}[$pesq_data->pesq_tipo]['nome_pesquisa']);
		// echo ${$pesq_data->pesquisa}[$pesq_data->pesq_tipo]][$nivel_pesquisa]['tempo_pesq'];
	endforeach;
	echo "</table>";
endif;
	



// validar uma nova pesquisa, aqui você vai pesquisar alguma coisa...
if(isset($_GET['pesq_tipo'])):

	// verificar o nível da sua pesquisa, pra adicionar 1 nível a mais...
	$pesq_select = $pdo_mysql->select_pdo("pesquisa","`uid` = {$_SESSION['uid']}");
	$pesq_andamento = $pdo_mysql->select_pdo("pesq_andamento","`uid` = {$_SESSION['uid']}");

	// verifica se existe alguma pesquisa em andamento...
	if(count($pesq_andamento) == 0):
		foreach($pesq_select as $pesq_data):
			$nivel_pesquisa = $pesq_data->{$_GET['pesq_tipo'] . $_GET['pesq_id']} + 1;
			$tempo_pesq = time() + ${$_GET['pesq_tipo']}[$_GET['pesq_id']][$nivel_pesquisa]['tempo_pesq'];
			$pdo_mysql->insert_pdo("pesq_andamento","(`id`, `uid`, `pesquisa`, `pesq_tipo`, `tempo_pesquisa`) VALUES (NULL, '{$_SESSION['uid']}', '{$_GET['pesq_tipo']}', '{$_GET['pesq_id']}', '{$tempo_pesq}');");
		endforeach;
		header("Location: ?ed=5");
	else:
		header("Location: ?ed=5");
	endif;

endif;

if(isset($_GET['pesq'])):
	$array = $$_GET['pesq'];
	for($nivel = 1; $nivel <= count($array); $nivel++):
		// printa todos as hierarquias da pesquisa_data...
		$pesquisas = $pdo_mysql->select_pdo_where("pesquisa","`uid` = {$_SESSION['uid']}");
		$nome_tabela = $_GET['pesq'];
		echo $array[$nivel]['nome_pesquisa'] . "<br />";
		for($sub_nivel = 1; $sub_nivel <= (count($array[$nivel])-1); $sub_nivel++):
			if($pesquisas[($nome_tabela . $nivel)] + 1 < $sub_nivel):
				echo "<strike><a href=\"?ed=5&pesq_tipo={$nome_tabela}&pesq_id={$nivel}\">Nível ".$sub_nivel." custo de ouro: ".$array[$nivel][$sub_nivel]['custo_ouro'] ."</a><br /></strike>";
			elseif($pesquisas[($nome_tabela . $nivel)] >= $sub_nivel):
				echo "<a href=\"?ed=5&pesq_tipo={$nome_tabela}&pesq_id={$nivel}\">Nível ".$sub_nivel." custo de ouro: ".$array[$nivel][$sub_nivel]['custo_ouro'] ."</a> (você já pesquisou isso.)<br />";
			else:
				echo "<a href=\"?ed=5&pesq_tipo={$nome_tabela}&pesq_id={$nivel}\">Nível ".$sub_nivel." custo de ouro: ".$array[$nivel][$sub_nivel]['custo_ouro'] ."</a><br />";
			endif;
		endfor;
	endfor;
endif;
?>