<?php
	$conn = mysql_connect('10.10.1.249', 'root', 'gemini35orion');
	if (!$conn) {
	    die('Could not connect: ' . mysql_error());
	};
	mysql_select_db('snapps_test');

// 	DROP TABLE IF EXISTS `itil_foundation_question`;
// 	CREATE TABLE IF NOT EXISTS `itil_foundation_question` (
// 			`id` bigint(10) NOT NULL auto_increment,
// 			`question` varchar(255) NOT NULL,
// 			`selection_a` varchar(255) NOT NULL,
// 			`selection_b` varchar(255) NOT NULL,
// 			`selection_c` varchar(255) NOT NULL,
// 			`selection_d` varchar(255) NOT NULL,
// 			`answer` char(1) NOT NULL,
// 			`reference` varchar(255) NOT NULL,
// 			`illustration` blob NOT NULL,
// 			PRIMARY KEY  (`id`)
// 	)	
	?>

