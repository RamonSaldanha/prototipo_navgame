<!doctype html>
<html>
<head>
<title>Aldeia</title>
<style>
/* Styles not relevant to scrolling (just to make the demo look neat and tidy) */
body { font-family: sans-serif; -webkit-text-size-adjust: 100%  padding:0; margin:0;}
#scrollable { height: 100%; width:100%;  }
p { color: gray }
.description { color: black }

/* Since the entire page is the scroll container, set body and html to 100% height to disable browser native scrolling.  Remove default padding or margin to avoid native scrollbars. */
#tabs { padding:0; margin:0;}
#tabs ul li { display: inline; padding:0; margin:0; }
#tabs ul {margin-left:-28px;}
body, html { height: 100%; overflow: hidden; padding: 0; margin: 0; }
</style>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
$( "#tabs" ).tabs();
});
</script>
<script type="text/javascript">
	function getContent( timestamp )
	{
		var queryString = { 'timestamp' : timestamp };
	 
		$.get ('longPollingServer.php' , queryString , function ( data )
		{
			var obj = jQuery.parseJSON( data );
			$( '#recursos' ).html( obj.content );
	 
			// reconecta ao receber uma resposta do servidor
			getContent( obj.timestamp );
		});
	}
	 
	$( document ).ready ( function ()
	{
		getContent();
	});
</script>

</head>
<body>
<div id="tabs">
<ul>
<li><a href="#tabs-1">Recursos |</a></li>
<li><a href="#tabs-2">outra coisa |</a></li>
<li><a href="#tabs-3">outra coisa 2</a></li>
</ul>
<div id="tabs-1">
	<div id="recursos"></div>
</div>
<div id="tabs-2">
outra coisa
</div>
<div id="tabs-3">
outra coisa 2
</div>
</div>

<div id='scrollable'>
<img src="modelo_grafico/img/bg.png" />
</div>

<script src='aldeia.scroller.js'></script>
<script>
var scroller = new FTScroller(document.getElementById('scrollable'), {
scrollingX: true
});
</script>


</body>
</html>