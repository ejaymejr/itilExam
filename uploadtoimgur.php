<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
?>
<?php include_once 'lib/_headerFile.php'; ?>
<?php include_once 'lib/_navigationBar.php'; ?>
<?php include_once 'lib/_connection.php'; ?>
<?php 
	// insert story
	if ($_SERVER['REQUEST_METHOD'] == 'POST'):
		$img=$_FILES['img'];
		if(isset($_POST['submit'])){
			if($img['name']==''){
				echo "<h2>An Image Please.</h2>";
			}else{
				$filename = $img['tmp_name'];
				$client_id="541eeff0627f891";
				$handle = fopen($filename, "r");
				$data = fread($handle, filesize($filename));
				$pvars   = array('image' => base64_encode($data));
				$timeout = 30;
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
				curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
				$out = curl_exec($curl);
				curl_close ($curl);
				$pms = json_decode($out,true);
				$url=$pms['data']['link'];
				if($url!=""){
					$sql = 'INSERT INTO whatsdis (url) values ("'.$url.'" )';
					$retval = mysql_query( $sql, $conn );
					if(! $retval )
					{
						die('Could not enter data: ' . mysql_error());
					}
					$lastID = mysql_insert_id();
					//echo "<h2>Uploaded Without Any Problem</h2>";
					//echo "<img src='$url'/>";
				}else{
					//echo "<h2>There's a Problem</h2>";
					//HTMLLib::vardump($pms['data']['error']);
				}
			}
		}
	endif;
	?>	
<html>

<body class="metro ">
<form action="index.php" enctype="multipart/form-data" method="POST">
	<div class="container">
        <header class="margin20 nrm nlm">
            <div class="clearfix">
                <div class="place-right">
                    <form>
                        <div class="input-control text size6 margin20 nrm">
                            <input type="text" name="q" placeholder="Search...">
                            <button class="btn-search"></button>
                        </div>
                    </form>
                </div>
                <a class="place-left" href="#" title="">
                    <h1>WATSDIS APP COMMUNITY</h1>
                </a>
            </div>
		<div class="">
		
	 <div class="grid">
     <div class="row">
         <div class="">
             <div class="row">
                 <div class="span6" >
	                <table class="table bordered ">
					<tr>
						<td class="bg-clearBlue text-right span2"><label>Upload Photo</label></td>
						<td class="span3">
							<div class="input-control file info-state span3" data-role="input-control">
		                        <input type="file" tabindex="-1" style="z-index: 0;" name="img">
		                        <input type="text" id="__input_file_wrapper__" readonly="" style="z-index: 1; cursor: default;">
		                        <button class="btn-file" type="button"></button>
		                    </div>
		                </td>
		                <td>
		                    <input type="submit" name="submit" value="Upload" class="success"/> 
						</td>
					</tr>
					<tr>
						<td colspan="3" class="text-center">
						
						<?php 
						if ($_SERVER['REQUEST_METHOD'] == 'POST'):
							if($url!=""): ?>
								<div class="image-container selected shadow">
								<a href="<?php echo $url ?>" target="_BLANK"><img src='<?php echo $url ?>' width='500px' /></a>
								</div>
						<?php 
							else:	
								echo "<h2>NO IMAGE LOADED</h2>";
							endif; 
						endif;
						?>
						</td>
					</tr>
					</table>
                 
                 </div>
                 <div class="span6" >
                 <table class="table bordered condensed">
					<tr>
						<td colspan="3">ANSWER(S)</td>
					</tr>
					<tr>
						<td class="bg-clearBlue span2 text-center"><small>User</small></td>
						<td class="bg-clearBlue text-center"><small>Comment</small></td>
						<td class="bg-clearBlue span1 text-center"><small>Date</small></td>
					</tr>
					<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST'):
						$sql = "select comment from comment where whatsdis_id = ". $lastID;
						$result = mysql_query( $sql, $conn );
						while ($row = mysql_fetch_assoc($result)) : ?>
							<tr>
								<td><small><?php echo $row['created_by'] ?></small></td>
								<td><small><?php echo $row['comment'] ?></small></td>
								<td><small><?php echo $row['date_created'] ?></small></td>
							</tr>
						<?php 
						endwhile; 
					endif;
					?>
					
					
                 </div>
             </div>
         </div>
     </div>
     </div>
</form> 
<table class="table bordered condensed">
	<tr>
		<td>test</td>
	</tr>
</table>			
				
					
                    
<!-- 				 Choose Image : <input name="img" size="35" type="file"/><br/> -->
<!-- 				 <input type="submit" name="submit" value="Upload"/> -->
			
		</div>
	<?php //include_once '_other_layout.php';?>
</body>
</html>

