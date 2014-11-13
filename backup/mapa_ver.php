<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
function alterarDisplay() {
  document.getElementById('carregar').style.display='none';
  document.getElementById('iframe').style.display='block';
}

</script>

<iframe id="iframe" onLoad="alterarDisplay()" width="500px" height="500px;" src="mapa_ver_data.php" style="display:none;"></iframe>
<div id="carregar">Carregando...</div>
