<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php include_once 'lib/_include_files.php'; ?>
<?php
	$lastQuestion = '';
	$lastID = 1;
	$question = '';
	$selection_a = '';
	$selection_b = '';
	$selection_c = '';
	$selection_d = '';
	$answer = '';
	$reference = '';
	$illustration = '';
	$lastID = 1;

	if ($_SERVER['REQUEST_METHOD'] <> 'POST'):
		$sql = "select * from itil_foundation_question where id = ". $lastID;
		$result = mysql_query( $sql, $conn );
		while ($row = mysql_fetch_assoc($result)) {
			$lastQuestion = HTMLLib::wysiwygFormat($row['question']);
		}
	endif;

	// insert Question
	if ($_SERVER['REQUEST_METHOD'] == 'POST'):
		$question = str_replace('"', '`', $_POST['question'] ) ;
// 		$selection_a = $_POST['selection_a'];
// 		$selection_b = $_POST['selection_b'];
// 		$selection_c = $_POST['selection_c'];
// 		$selection_d = $_POST['selection_d'];
// 		$answer = $_POST['answer'];
// 		$reference = $_POST['reference'];
		//$illustration = $_POST['illustration'];
		
		//-----------------------
		
		$questions = explode('QUESTION', $question);
		unset($questions[0]); 
		//HTMLLib::vardump($questions); 
		foreach($questions as $q):
			$sel_a_pos = strpos($q, 'A.');
			$sel_b_pos = strpos($q, 'B.');
			$sel_c_pos = strpos($q, 'C.');
			$sel_d_pos = strpos($q, 'D.');
			$ans_pos   = strpos($q, 'Correct Answer:');
			$question 		= substr($q, 0, $sel_a_pos - 1);
			$selection_a 	= substr($q, $sel_a_pos + 2, $sel_b_pos - $sel_a_pos - 2 );
			$selection_b 	= substr($q, $sel_b_pos + 2, $sel_c_pos - $sel_b_pos - 2 );
			$selection_c 	= substr($q, $sel_c_pos + 2, $sel_d_pos - $sel_c_pos - 2 );
			$selection_d 	= substr($q, $sel_d_pos + 2, $ans_pos - $sel_d_pos - 2 );
			$answer 		= substr($q, $ans_pos + 17, 1 );
			echo 'question:' . $question . '<br>A.' . $selection_a  . '<br>B.' . $selection_b  . '<br>C.' . $selection_c  . '<br>D.' . $selection_d  . '<br>Answer: ' . $answer .'<br>---------------------------------<br>';
		
			$sql = 'INSERT INTO itil_foundation_question (question, selection_a, selection_b, selection_c, selection_d, answer, reference, illustration) 
					values ("'.$question.'", "'.$selection_a.'", "'.$selection_b.'", "'.$selection_c.'", "'.$selection_d.'", "'.$answer.'",  "'.$reference.'", "'.$illustration.'"  )';
	
			$retval = mysql_query( $sql, $conn );
		endforeach;
		if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
		}
//		echo "Data has been saved successfully!\n";
		
		$lastID = mysql_insert_id();
		$sql = "select story from itil_foundation_question where id = ". $lastID;
		$result = mysql_query( $sql, $conn );
		$lastQuestion = '';
		while ($row = mysql_fetch_assoc($result)) {
			$lastQuestion 	 .= 'Question: ' . $_POST['question'] .'<br>';
			$lastQuestion 	 .= 'A: ' . $_POST['selection_a'] .'<br>';
			$lastQuestion 	 .= 'B: ' . $_POST['selection_b'] .'<br>';
			$lastQuestion 	 .= 'C: ' . $_POST['selection_c'] .'<br>';
			$lastQuestion 	 .= 'D: ' . $_POST['selection_d'] .'<br>';
			$lastQuestion 	 .= 'Answer: ' . $_POST['answer'] .'<br>';
			$lastQuestion 	 .= 'Reference: ' . $_POST['reference'] .'<br>';
			$lastQuestion 	 .= 'Fig: ' . $_POST['illustration'];
		}
// 		mysql_close($conn);
// 		echo '<pre>';
// 		print_r($retval);
// 		echo '</pre>';
	endif;
?>
<html>

<body class="metro ">
	<form id="addQuestionaire" name="addQuestionaire" action="itil_pdf.php" method="post">
	<div class="example">
		<table class="table bordered condensed">
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Last Question</label></td>
				<td class=""><?php 
					echo $lastQuestion;
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Question</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateTextArea('question', '', 'span12', '', 'rows="8" cols="80"')
				?></td>
			</tr>
			
			<tr>
				<td class="bg-clearBlue text-right span2"><label></label></td>
				<td class=""><?php 
					echo HTMLLib::CreateSubmitButton('save', 'Save Question')
				?></td>
			</tr>
			<tr>
				<td></td>
			</tr>	
		</table>
		
	</div>
</body>