<?php

$dataFileName = 'modelos/longPolling_Recursos.php';

while ( true )
{
    
    $requestedTimestamp = isset ( $_GET [ 'timestamp' ] ) ? (int)$_GET [ 'timestamp' ] : null;
 

    clearstatcache();
    $modifiedAt = filemtime( $dataFileName );
 
    if ( $requestedTimestamp == null || $modifiedAt > $requestedTimestamp )
    {
        $data = include "$dataFileName";
 
        $arrData = array(
            'content' => $data,
            'timestamp' => 1
        );
 
        $json = json_encode( $arrData );
 
        echo $json;
 
        break;
    }
    else
    {
        sleep( 2 );
        continue;
    }
}