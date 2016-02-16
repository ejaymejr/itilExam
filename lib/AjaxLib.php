<?php
class AjaxLib
{
	
	public static function AjaxScript($elementID, $Url, $paramVar, $extra=null, $updateDIVID=null)
	{
		//[$elementID] = trigger HTML Elements like Submit button or checkbox / CLICK triggering factor
		//[$extra]= 'customer='+customer+'&email='+email+'&dept=". $department ."' ;";
		//[$Url]     = var $Url = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ."' ;
		//[$paramVar]     = 'customer,cemail_address,' these are all input box
		//.php file
		//$extraparm = 'shift='.$shift .'&dept='.$dept;
		//echo AjaxLib::AjaxScript($shiftVar, 'photo/ajaxUpdateEmail', 'customer,cemail_address,cname',$extraparm,'deptShiftInfo')
	    // update DIV is important
	    
		//$loadUrl = $_SERVER['SCRIPT_NAME'] . '/'  . $Url;
		$loadUrl = $Url;
		$updateDIVID = $updateDIVID? $updateDIVID : 'main';
		return "
			<!-- beta ajax -->
			<script type='text/javascript'>
			$(document).ready(function(){
				$('#".$elementID."').click({loadUrl: '".$loadUrl."'
				, param: '".$paramVar."'
				, update: '#".$updateDIVID."'
				, extraparams: '".$extra."'
				}, doAjax);
						
			});
			
			</script>";
	}
	
	public static function AjaxInDialogScript($elementID, $Url, $paramVar, $extra=null, $updateDIVID=null)
	{
		//[$elementID] = trigger HTML Elements like Submit button or checkbox / CLICK triggering factor
		//[$extra]= 'customer='+customer+'&email='+email+'&dept=". $department ."' ;";
		//[$Url]     = var $Url = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ."' ;
		//[$paramVar]     = 'customer,cemail_address,' these are all input box
		//.php file
		//$extraparm = 'shift='.$shift .'&dept='.$dept;
		//echo AjaxLib::AjaxScript($shiftVar, 'photo/ajaxUpdateEmail', 'customer,cemail_address,cname',$extraparm,'deptShiftInfo')
	    // update DIV is important
	    
		$loadUrl = $_SERVER['SCRIPT_NAME'] . '/'  . $Url;
		$updateDIVID = $updateDIVID? $updateDIVID : 'main';
		$script = '';
		$script .= '$(document).ready(function(){+';
		$script .= '$("#'.$elementID.'").click({loadUrl: "'.$loadUrl.'"+';
		$script .= ', param: "'.$paramVar.'"+';
		$script .= ', update: "#'.$updateDIVID.'"+';
		$script .= ', extraparams: "'.$extra.'"+';
		$script .= '}, doAjax);+';
		$script .= '});';
		return $script;
	}
	
	public static function AjaxScriptOnChange($elementID, $Url, $paramVar, $extra=null, $updateDIVID=null)
	{
		//[$elementID] = trigger HTML Elements like Submit button or checkbox / CLICK triggering factor
		//[$extra]= 'customer='+customer+'&email='+email+'&dept=". $department ."' ;";
		//[$Url]     = var $Url = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ."' ;
		//[$paramVar]     = 'customer,cemail_address,' these are all input box
		//.php file
		//$extraparm = 'shift='.$shift .'&dept='.$dept;
		//echo AjaxLib::AjaxScript($shiftVar, 'photo/ajaxUpdateEmail', 'customer,cemail_address,cname',$extraparm,'deptShiftInfo')
	
		$loadUrl = $_SERVER['SCRIPT_NAME'] . '/'  . $Url;
		$updateDIVID = $updateDIVID? $updateDIVID : 'main';
		return "
			<!-- beta ajax -->
			<script type='text/javascript'>
			$(document).ready(function(){
				$('#".$elementID."').change({loadUrl: '".$loadUrl."'
				, param: '".$paramVar."'
				, update: '#".$updateDIVID."'
				, extraparams: '".$extra."'
				}, doAjax);
			});
			</script>";
	}
	
	public static function AjaxScriptOnBlur($elementID, $Url, $paramVar, $extra=null, $updateDIVID=null)
	{
		//[$elementID] = trigger HTML Elements like Submit button or checkbox / CLICK triggering factor
		//[$extra]= 'customer='+customer+'&email='+email+'&dept=". $department ."' ;";
		//[$Url]     = var $Url = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ."' ;
		//[$paramVar]     = 'customer,cemail_address,' these are all input box
		//.php file
		//$extraparm = 'shift='.$shift .'&dept='.$dept;
		//echo AjaxLib::AjaxScript($shiftVar, 'photo/ajaxUpdateEmail', 'customer,cemail_address,cname',$extraparm,'deptShiftInfo')
	
		$loadUrl = $_SERVER['SCRIPT_NAME'] . '/'  . $Url;
		$updateDIVID = $updateDIVID? $updateDIVID : 'main';
		return "
			<!-- beta ajax -->
			<script type='text/javascript'>
			$(document).ready(function(){
				$('#".$elementID."').blur({loadUrl: '".$loadUrl."'
				, param: '".$paramVar."'
				, update: '#".$updateDIVID."'
				, extraparams: '".$extra."'
				}, doAjax);
			});
			</script>";
	}
	
	public static function SaveDescriptionAjax($sourceID, $targetList)
	{
		$fileID = str_replace('.', '_', $sourceID);
		$ajaxString = "
		var ajax_load = '<div id=\"showloader\"></div>';
		var loadUrl = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ."' ;
		var descriptionEntry = $('#description_text_". $fileID ."').val();
		var withparams = 'description='+descriptionEntry+'&fname=". $sourceID ."' ;";
		foreach($targetList as $targetID):
		$ajaxString .=
		"$('#".$targetID.$fileID."')
					.html(ajax_load)
					.load(loadUrl, withparams );
				";
		endforeach;
		return $ajaxString;
	
		/* var ajax_load = '<div id=\"showloader\"></div>';
		 var loadUrl = '<?php echo $_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ?>' ;
		var descriptionEntry = $('#description_text_<?php echo $fileID ?>').val();
		var withparams = 'description='+descriptionEntry+'&fname=<?php echo $file?>' ;
		//$('#FullDescription_<?php echo $fileID ?>').val($('#description_text_<?php echo $fileID ?>').val());
		$('#Description_<?php echo $fileID ?>')
		.html(ajax_load)
		.load(loadUrl, withparams );
		$('#FullDescription_<?php echo $fileID ?>')
		.html(ajax_load)
		.load(loadUrl, withparams );
			
		//alert( $('#FullDescription_<?php echo $fileID ?>').val());
			
		return false;
		*/
	}
	
	public static function DeletePhotoAjax($sourceID, $targetID)
	{
		$fileID = str_replace('.', '_', $sourceID);
		$ajaxString = "
		var ajax_load = '<div id=\"showloader\"></div>';
		var loadUrl = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/deleteFile' ."' ;
		var withparams = 'file=". $sourceID ."' ;";
		$ajaxString .=
		"$('#".$targetID."')
					.html(ajax_load)
					.load(loadUrl, withparams );
				";
		//$url = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		//$ajaxString = '';
		//$ajaxString .= "window.location.href = ''; ";
		return $ajaxString;
	}
	
	public static function GetGarmentInformation($garmentCode, $targetID)
	{
		//$fileID = str_replace('.', '_', $sourceID);
		$ajaxString = "
		var ajax_load = '<div id=\"showloader\"></div>';
		var loadUrl = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxGarmentInformation' ."' ;
		var withparams = 'garment_code=' + $('#garment_code').val() ;";
		$ajaxString .=
		"$('#".$targetID."')
					.html(ajax_load)
					.load(loadUrl, withparams );
				";
		//$url = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		//$ajaxString = '';
		//$ajaxString .= "window.location.href = ''; ";
		return $ajaxString;
	}
	
	public static function SearchHeaderAjax($submitID, $Url, $paramVar, $updateID, $extraParameters)
	{
		$extra = 'isAjax=true' . $extraParameters;
		return "
			<!-- beta ajax -->
			<script type='text/javascript'>
			$(document).ready(function(){
				$('#".$submitID."').click({loadUrl: '".$Url."'
				, param: '".$paramVar."'
				, update: '#".$updateID."'
				, extraparams: '".$extra."'
				}, doAjax);
			});
			</script>";
	
		// 		$(document).ready(function(){
		// 			$('#c4nxmwli3e').click({loadUrl: '/micronclean/reject/reject_dev.php/photo/upload'
		// 					, param: 'trans_date,customer,garment,color,size,department,shift'
		// 							, update: '#etphwnlb9t'
		// 									, extraparams: 'isAjax=true'
		// 			}, doAjax);
		// 		});
	}
	
	// 	public static function AjaxScript($elementID, $Url, $paramVar, $extra=null, $updateDIVID=null)
	// 	{
	// 		//[$elementID] = trigger HTML Elements like Submit button or checkbox / CLICK triggering factor
	// 		//[$extra]= 'customer='+customer+'&email='+email+'&dept=". $department ."' ;";
	// 		//[$Url]     = var $Url = '".$_SERVER['SCRIPT_NAME'] .'/'. 'photo/ajaxSaveDescription' ."' ;
	// 		//[$paramVar]     = 'customer,cemail_address,' these are all input box
	// 		$loadUrl = $_SERVER['SCRIPT_NAME'] . '/'  . $Url;
	// 		$updateDIVID = $updateDIVID? $updateDIVID : 'main';
	// 		return "
	// 			<!-- beta ajax -->
	// 			<script type='text/javascript'>
	// 			$(document).ready(function(){
	// 				$('#".$elementID."').click({loadUrl: '".$loadUrl."'
	// 				, param: '".$paramVar."'
	// 				, update: '#".$updateDIVID."'
	// 				, extraparams: '".$extra."'
	// 				}, doAjax);
	// 			});
	// 			</script>";
	// 	}
	
	
}
