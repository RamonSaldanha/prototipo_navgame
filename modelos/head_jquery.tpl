
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