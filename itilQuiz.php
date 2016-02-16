<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php include_once 'lib/_include_files.php'; ?>
<?php 
// if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
//     echo 'mobile';
// }  ?>
<?php
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
?>
<html>

<?php 
		$sql = "select id from itil_foundation_question";
		$result = mysql_query( $sql, $conn );
		$ids = array();
		while ($row = mysql_fetch_assoc($result)) {
			$ids[] = $row['id'];
		}
?>
<body class="metro ">
	<div  class="examples">
		<div id="examSheet">
			<table class="table bordered condensed">
			<tr>
				<td class="text-center">
				<script>
					$("#start").click( function (){
						alert("test");
					});
				</script>
				<?php 
					//HTMLLib::vardump($_SERVER);
					//$url =  'loadQuiz.php?id=1';
					//echo AjaxLib::AjaxScript('start', $url, '', 'id='.$ids[0], 'examSheet');
					//echo AjaxLib::AjaxScript('start', $url, '', 'id=0', 'examSheet');
					
				?>
				<a id="start" href="loadQuiz.php?id=1"> <img src="./images/itil_logo.jpg" class="rounded  polaroid" class="hovered"></a>
				<div><small>click to start</small></div>
				</td>
			</tr>
			</table>
		</div>
		<?php //include_once '_ajaxQuizItem.php';?>
	</div>
</body>