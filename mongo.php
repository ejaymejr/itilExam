<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	phpinfo();
?>
<?php include_once 'lib/_headerFile.php'; ?>
<?php include_once 'lib/_navigationBar.php'; ?>
<?php include_once 'lib/_mongo_connection.php'; ?>
<?php include_once 'lib/HTMLLib.php'; ?>
  <body class="metro">
  	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas"></div>
  </body>

