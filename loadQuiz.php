<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>

<?php include_once 'lib/_headerFile.php'; ?>
<?php include_once 'lib/_navigationBar.php'; ?>
<?php include_once 'lib/_connection.php'; ?>
<?php include_once 'lib/HTMLLib.php'; ?>
<?php include_once 'lib/AjaxLib.php'; ?>
<?php 

$question = '';
$selection_a = '';
$selection_b = '';
$selection_c = '';
$selection_d = '';
$answer = '';

$id = $_GET['id'];
$isRandom = 0; //false
// if ($_SERVER['REQUEST_METHOD'] == 'GET'):
// 	$id = $_GET['id'];
// 	$isRandom = (isset( $_GET['randomize'])? $_GET['randomize'] : 'false' );
// else:
// 	$id = $_POST['id'];
// 	$isRandom = (isset( $_POST['randomize'])? $_POST['randomize'] : 'false' );
// endif;

		if (! $isRandom ):
			$sql = "select * from itil_foundation_question where id = ".$id." LIMIT 0,1";
		else:
			$sql = "select * from itil_foundation_question ordery by rand() LIMIT 0,1";
		endif;
		$result = mysql_query( $sql, $conn );
		$ids = array();
		$answers = array();
		$shuffleAnswers = array();
		$reference = '';
		while ($row = mysql_fetch_assoc($result)) {
			$id = $row['id'];
			$question = $row['question'];
			
			$answers[] = $row['selection_a'];
 			$answers[] = $row['selection_b'];
 			$answers[] = $row['selection_c'];
 			$answers[] = $row['selection_d'];
 			$answer = $row['selection_' . strtolower($row['answer']) ];
 			$reference = $row['reference'];
 			
			//shuffle($answers);
		}
?>
<body class="metro ">
    <div class="grid" id="examSheet">
        <div class="row">
            <div class="span6">
<!--             This is where the questionaire portion -->
            <table class="table bordered condensed ">
				<tr>
					<td class=" text-right span1" colspan="2">
						<H4>ITIL FOUNDATION V3 EXAM SIMULATOR</H4>
					</td>
				</tr>
				<tr>
					<td class="bg-clearBlue text-right "><label></label></td>
					<td class=""><small><strong>
					<?php 
						echo 'Question '. HTMLLib::wysiwygFormat($question);
					?></strong></small></td>
				</tr>
				<?php 
					$selection = array(0 => 'A', 1 => 'B', 2 => 'C' ,3 => 'D');
					$pos = 0;
					$correctAnswer = '';
					foreach($answers as $a): 
						if ($a == $answer):
							$correctAnswer = $selection [$pos];
						endif;
				?>
				<tr id="selectionID_<?php echo $selection[$pos]?>" class="" >
					<td class="bg-clearBlue text-right "><label><?php echo $selection [$pos]?></label></td>
					<td class=""><label><small>
						<?php 
						echo $a;
						?>
						</small></label>
					</td>
				</tr>
				<?php 
					$pos++;
					endforeach; 
				?>
				
				<tr>
					<td class="bg-clearBlue text-right "><label>Answer</label></td>
					<td  class="fg-blue" >		
						<button id="btnShowID" class="command-button success span3" >
						    <i class="icon-screen on-left"></i>
						    Show Answer
						    <small><small></small></small>
						</button>
						<script>
							$( "#btnShowID" ).click(function() {
							  $("#selectionID_<?php echo $correctAnswer ?>").addClass(" bg-clearRed ");
							  return;
							});
						</script>
					</td>
				</tr>
				<tr>
					<td class="bg-clearBlue text-right "><label></label></td>
					<td>
						<a href="loadQuiz.php?id=<?php echo $id + 1?>" id="start" class="command-button primary span3">
						    <i class="icon-spin on-left"></i>
						    Next Question
						    <small><small></small></small>
						</a>
						<?php 
							//$url =  'loadQuiz.php';
							//echo AjaxLib::AjaxScript('start', $url, '', 'id='.$id, 'examSheet');
						?>
						</td>
				</tr>
				
			</table>
            
            </div>
            
            <div class="span6">
            <?php 
            	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) :
					 ?>
            	<table class="table bordered condensed ">
				<tr class="bg-clearOrange" >
					<td class=" text-right span1 " colspan="2">
						<H4>STUDY NOTES</H4>
					</td>
				</tr>
				<tr>
					<td class="">
						<?php 
								echo HTMLLib::wysiwygFormat($reference);
							
							?>
					</td>
				<tr>
				</tr>
				</table>
				<?php else:	?>
							
            	<table class="table bordered condensed ">
				<tr class="bg-clearOrange">
					<td class=" text-right span1" colspan="2">
						<H4>STUDY NOTES</H4>
					</td>
				</tr>
				<tr>
					<td class="">
						<?php 
								echo HTMLLib::CreateTextArea('reference', HTMLLib::wysiwygTextArea($reference), 'span6', '', 'rows="15"' );
							
							?>
					</td>
					
				<tr>
				<tr>
					<td class="">
						<a href="http://wiki.en.it-processmaps.com/index.php/ITIL_Glossary#ITIL%20Glossary%20A-Z"
							target="_BLANK">Glossary of Terms</a>
						<div id="referenceStatus"></div>
					</td>
				<tr>
					<td>
						<button id="saveReference" class="command-button primary span3">
						    <i class="icon-database on-right"></i>
						    Save This Reference
						    <small><small></small></small>
						</button>
						<?php 
							$url =  'saveQuizReference.php';
							echo AjaxLib::AjaxScript('saveReference', $url, 'reference', 'id='.$id , 'referenceStatus');
						?>
					</td>
				</tr>
				</table>
				<?php endif; ?>
            </div>
        </div>
        <div class="row">
        	<div class="span12">
        		<?php include_once 'lectureSlides.php';?>
        	</div>
        </div>
        <div class="row">
        	<div class="span12">
        		<?php include_once 'service_operation_glossary.php';?>
        	</div>
        </div>
    </div>
</body>   

