<?php
header('Content-Type: application/json; charset=utf-8');
$dataFileName = 'modelos/longPolling_Recursos.php';

//fetch data
$data_include = include "$dataFileName";
$data = (true) ? array('aaa' => $data_include) : array();
//there is no data updated
if (empty($data)) {
    header('HTTP/1.0 204 No Content');
    die;
}
echo json_encode($data);
flush();
exit(0);