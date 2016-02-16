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
		$question = $_POST['question'];
		$selection_a = $_POST['selection_a'];
		$selection_b = $_POST['selection_b'];
		$selection_c = $_POST['selection_c'];
		$selection_d = $_POST['selection_d'];
		$answer = $_POST['answer'];
		$reference = $_POST['reference'];
		$illustration = $_POST['illustration'];
		
		//-----------------------
		
// 		$questions = explode('QUESTION', $question);
// 		HTMLLib::vardump($questions); 
		
		//-----------------------
		
		$sql = 'INSERT INTO itil_foundation_question (question, selection_a, selection_b, selection_c, selection_d, answer, reference, illustration) 
				values ("'.$question.'", "'.$selection_a.'", "'.$selection_b.'", "'.$selection_c.'", "'.$selection_d.'", "'.$answer.'",  "'.$reference.'", "'.$illustration.'"  )';

		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
		}
		echo "Data has been successfully!\n";
		
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
	<form id="addQuestionaire" name="addQuestionaire" action="itilAdd.php" method="post">
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
					echo HTMLLib::CreateTextArea('question', $question, 'span12')
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Selection A</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateInputText('selection_a', $selection_a)
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Selection B</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateInputText('selection_b', $selection_b)
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Selection C</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateInputText('selection_c', $selection_c)
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Selection D</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateInputText('selection_d', $selection_d)
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Answer</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateTextArea('answer', $answer, 'span12')
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Reference</label></td>
				<td class=""><?php 
					echo HTMLLib::CreateInputText('reference', $reference)
				?></td>
			</tr>
			<tr>
				<td class="bg-clearBlue text-right span2"><label>Illustration</label></td>
				<td class=""><?php 
					//echo HTMLLib::CreateInputText('illustration', $illustration)
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