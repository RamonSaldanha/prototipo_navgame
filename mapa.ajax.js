// Função que verifica se o navegador tem suporte AJAX 
function AjaxF()
{
	var ajax;
	
	try
	{
		ajax = new XMLHttpRequest();
	} 
	catch(e) 
	{
		try
		{
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e) 
		{
			try 
			{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e) 
			{
				alert("Seu browser não da suporte à AJAX!");
				return false;
			}
		}
	}
	return ajax;
}

// Função que faz as requisição Ajax ao arquivo PHP
function moverX(coordenada)
{
	var ajax = AjaxF();	
	
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4)
		{
			document.getElementById('mapa').innerHTML = ajax.responseText;
		}
	}
	var y1 = document.getElementById('coordenadaY').value;
	var x1 = document.getElementById('coordenadaX').value;
	var calculo = parseInt(x1)+parseInt(coordenada);
	// Variável com os dados que serão enviados ao PHP
	var dados = "x1="+calculo+"&y1="+y1;
	ajax.open("GET", "mapa.data.php?"+dados, false);
	ajax.setRequestHeader("Content-Type", "text/html");
	ajax.send();
}

function moverY(coordenada)
{
	var ajax = AjaxF();	
	
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4)
		{
			document.getElementById('mapa').innerHTML = ajax.responseText;
		}
	}
	var y1 = document.getElementById('coordenadaY').value;
	var x1 = document.getElementById('coordenadaX').value;
	var calculo = parseInt(y1)+parseInt(coordenada);
	// Variável com os dados que serão enviados ao PHP
	var dados = "x1="+x1+"&y1="+calculo;
	ajax.open("GET", "mapa.data.php?"+dados, false);
	ajax.setRequestHeader("Content-Type", "text/html");
	ajax.send();
}
