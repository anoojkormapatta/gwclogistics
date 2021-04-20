<?php
header("Content-Type: application/json;charset=utf-8");

try{
	include '_webservice.php';
	echo json_encode(array($cur, $trnd.' '.$nchn, $vol));
}
catch (Exception $ex){
	header("HTTP/1.0 404 Not Found");
	header('HTTP', true, 500);
}
?>
