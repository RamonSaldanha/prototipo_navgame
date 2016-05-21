<?php
require_once("engine/autoload.php");
?>
<?php
$pdo_mysql = new pdo_mysql();
$consulta = $pdo_mysql->show_tables_name();
echo "<ul>";
foreach($consulta as $nome_tabelas):
	echo "<li><a href='?subpg={$nome_tabelas}'>" . $nome_tabelas . "</a></li>";
endforeach;
echo "</ul>"
?>
<a  href="?pg=administrador&subpg=usuario"> usuarios </a><br/>

<?php
/////// LEMBRE-SE PARA SEGURANÇA DESSES SCRIPTS, USAR PREFIXO NAS TABELAS DO BD! \\\\\\\\\

if(!empty($_GET['subpg'])):
	require_once("engine/autoload.php");
	$pdo_mysql = new pdo_mysql();
	if(!empty($_GET['deletar'])):
		$pdo_mysql->delete_pdo($_GET['subpg'],"`id` = '{$_GET['deletar']}'");
	endif;

	if(!empty($_POST['alterar'])):
		foreach ($_POST as $tabela => $conte):
			$pdo_mysql->update_pdo($_GET['subpg'],"`$tabela` = '$conte'","`id` = '{$_POST['id']}'");
		endforeach;
	endif;
	
	if(!empty($_POST['inserir'])):
		$x = 0;
		foreach ($_POST as $tabela => $conteudo):
			
			$quantidade_total = count($_POST);

			switch($tabela):
				case "id":
					
				break;
				case "inserir":

				break;
				default:

					
			endswitch;
			
			if($tabela == "id"):
				@$string_array_tabela = $string_array_tabela."`$tabela`, ";
				@$string_array_conteudo = $string_array_conteudo."'NULL', ";
			elseif ($tabela == "inserir"):
				@$string_array_tabela = $string_array_tabela."";
				@$string_array_conteudo = $string_array_conteudo."";
			elseif ($x == $quantidade_total - 2 ):
				@$string_array_tabela = $string_array_tabela."`$tabela`";
				@$string_array_conteudo = $string_array_conteudo."'$conteudo'";			
			else:
				@$string_array_tabela = $string_array_tabela."`$tabela`, ";
				@$string_array_conteudo = $string_array_conteudo."'$conteudo', ";
			endif;


			$x++;
		endforeach;

		$inserir = "(" . $string_array_tabela .") VALUES (" . $string_array_conteudo . ")";
		$pdo_mysql->insert_pdo($_GET['subpg'],$inserir);
	endif;
	$consulta = $pdo_mysql->select_pdo_assoc_all("{$_GET['subpg']}");
	// nessa primeira foreach abaixo, ele vai pegar todas as consultas da tabela
	// que a variavel subpg vai transmitir, e ai vai criar um array para cada registro nessa tabela
	echo "<h2>CONSULTAR</h2>";
	foreach ($consulta as $tconsultar):
		echo "<form action='?pg=administrador&subpg=". $_GET['subpg'] . "' method='POST'>";
		// esse 2º foreach irá transformar o registro da primeira array em uma tabela com valor
		// desta forma, ele vai mostrar detalhadamente a celula da tabela e o conteudo dela
		$id = $tconsultar["id"];
		foreach($tconsultar as $tabela => $conteudo):

			if($tabela == 'id'):
				echo strtoupper($tabela) . ": <input type='text' style='width:60px;'name='$tabela' readonly='readonly' value='{$conteudo}'> ";
			else:
				echo strtoupper($tabela) . ": <input type='text' name='{$tabela}' style='width:60px;' value='{$conteudo}' /> ";
				//echo "(<a href='?pg=administrador&subpg={$_GET['subpg']}&{$tabela}={$conteudo}&id={$id}'>alterar</a>) / ";
			endif;

			
		endforeach;
		echo "<button type='submit' name='alterar' value='alterar'>Alterar </button>";
		echo " <a href='?pg=administrador&subpg={$_GET['subpg']}&deletar={$tconsultar["id"]}'>Deletar</a>";
		echo "</form>";
		echo "<hr /></br>";
	endforeach;
	echo "<h2>INSERIR</h2>";
	$tabela_consulta = $pdo_mysql->select_pdo_assoc("{$_GET['subpg']}");
	echo "<form action='?pg=administrador&subpg=". $_GET['subpg'] ."' method='POST'>";
	foreach ($tabela_consulta as $tabela => $conteudo):	
		if($tabela == 'id'):
				echo strtoupper($tabela) . ": <input type='text' style='width:60px;'name='$tabela' readonly='readonly' value=''> ";
			else:
				echo strtoupper($tabela) . ": <input type='text' name='{$tabela}' style='width:60px;' value='' /> ";
			endif;
	endforeach;
	echo "<br /><button type='submit' name='inserir' value='inserir'>Inserir</button>";
	echo "</form>";
endif;
?>
