<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php include_once 'lib/_connection.php'; ?>
<?php include_once 'lib/HTMLLib.php'; ?>
<?php
	
	// insert Reference
	if ($_SERVER['REQUEST_METHOD'] == 'GET'):
		
		$id = $_GET['id'];
		
		$reference = $_GET['reference'];
		
		$sql = 'Update itil_foundation_question set reference = "' . $reference .'" where id = ' . $id;

		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
		}
		echo "Reference has been Saved!\n";
		
	endif;
?>
