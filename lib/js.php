<?php

ob_start ("ob_gzhandler");
header( 'Expires: Mon, 26 Jul 2010 05:00:00 GMT' );
header( 'Last-Modified:  Mon, 26 Jul 2000 05:00:00 GMT' );
//header( 'Cache-Control: no-store, no-cache, must-revalidate' );
//header( 'Cache-Control: post-check=0, pre-check=0', false );
//header( 'Pragma: no-cache' );
header('Content-type: text/javascript');

ini_set('error_reporting', 4095);
ini_set('display_errors', true);

$jsFiles = array(
		"./js/docs",


);

$scriptfile = App_Minifier::fetch('scripts', 'temp', $jsFiles);
?>
