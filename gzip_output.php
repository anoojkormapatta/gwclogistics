<?php

$filePath = $_GET['uri'];

$filePartsArray =  explode( '.', $filePath );
$filePathExtension = strtolower( end( $filePartsArray ) );

if(file_exists($filePath)) {
	$fileContent = file_get_contents( $filePath );

	if (function_exists('ob_gzhandler')) ob_start("ob_gzhandler");
	if (function_exists("ob_gzhandler_no_errors")) ob_start();

	if ($filePathExtension == 'css') { header('Content-type: text/css; charset=utf-8');  }
	if ($filePathExtension == 'js') { header('Content-type: text/javascript; charset=UTF-8');  }
	if ($filePathExtension == 'svg') { header('Content-type: svg+xml');  }

	echo $fileContent;
}