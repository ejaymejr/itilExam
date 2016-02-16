<?php
class HTMLLib
{

	
	public static function CreateSelectSearch($varname, $value, $options, $span=null)
	{
		$content  = '';
		$divName  = $varname.'_DropDownDIVSearch';
		$filename = self::DropDownPager($options, $divName, $varname);
		$content  = PagerJson::AkoTableForDropDownSelect(array('seq' ,'desc'), $filename );
		$content  = preg_replace('/^\s+|\n|\r|\s+$/m', '', $content);
		$msg = '';
		$mess = '';
		$span = $span? $span : 'span6';
		$shownumberOfRows = "10";
		//$msg .= "<button id='showWindow' class='button'>Create Window</button>";
		$msg .= self::CreateInputText($varname, $value, $span);
		$msg .= "<a href='#' onclick='showhideDIV(".'"'.$divName.'"'."); return false;'><i class='icon-search on-right on-left ' style='background: #7AD61D; color: white; padding: 10px; border-radius: 50%'></i></a>";
		$msg .= '
			<div id="'.$divName.'" class="DropDownDIVSearch " style="visibility:hidden">
		    <div class="window  '.$span.'">
			    <div class="caption">
			    <span class="icon icon-search fg-white"></span> 
			    <div class="title fg-white">SELECTOR WINDOW</div> 
			    </div>
			    <div class="content ">
			    '.$content.'
			    </div>
		    </div>
		    </div>
		';
		return $msg;
		
	}
	
	public static function DropDownPager($pager, $divName, $targetElement)
	{
		$data = array();
		$seq = 0;
		$tElement = "'". $targetElement ."'";
		$divName = "'". $divName ."'";
		foreach ($pager as $key => $record):
			$seq ++ ;
			$val = "'". $record ."'";
			$desclink = '<a href="#" onclick="showhideDIV('.$divName.'); showhideDIVUpdate('.$divName.','.$val.','.$tElement.');  return false;" data="rec">'.$record.'</a>';
			$data[] = array(
					 'seq'=>'<span class="alignCenter">'.$seq.'</span>'
					, 'desc'=>'<small>'.$desclink.'<small>'
			);
		endforeach;
		return $data;
	}
	
	
	public static function CreateInputText($id, $value, $span=null, $isNormal=null, $any=null)
	{
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
			'.$small1.'
			<div class="input-control text '.$span.' ">
				<input id="'.$id.'" name="'.$id.'" type="text" value="'.$value.'" placeholder="input '.$id.'" '.$any.' />
				<button class="btn-clear"></button>
			</div>
			'.$small2.'
		';
	}
	
	public static function CreateCheckBox($id, $label, $chkd=null, $span=null, $isNormal=null)
	{
		if ($chkd == 'YES' || $chkd == 'on' || $chkd == true):
			$chkd = 'checked';
		endif;
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		//var_dump(sfContext::getInstance()->getResponse()->getParameter('primary_ed'));
		return '
			'.$small1.'
			<div class="input-control checkbox '.$span.' ">
				<label>
				<input id="'.$id.'" value="'.$id.'" name="'.$id.'" type="checkbox"  '.$chkd.'  />
				<span class="check"></span>
				'.$label.'	
				<label>
			</div>
			'.$small2.'
		';
	}
	
	public static function CreateRadio($id, $label, $chkd=null, $span=null, $isNormal=null)
	{
		//var_dump(sfContext::getInstance()->getResponse()->getParameter('primary_ed'));
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
			'.$small1.'
			<div class="input-control radio '.$span.' ">
				<label>
				<input id="'.$id.'" name="'.$id.'" type="radio"  '.$chkd.' value="'.$label.'" />
				<span class="check"></span>
				'.$label.'	
				<label>
			</div>
			'.$small2.'
		';
	}
	
	public static function CreateTextArea($id, $value, $span=null, $isNormal=null, $options=null)
	{
		//var_dump(sfContext::getInstance()->getResponse()->getParameter('primary_ed'));
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
			'.$small1.'
			<div class="input-control textarea '.$span.' ">
				<textarea id="'.$id.'" name="'.$id.'" placeholder="input '.$id.'" '.$options.' >'.$value.'</textarea>
			</div>
			'.$small2.'
		';
	}
	
	public static function CreateSubmitButton($id, $message)
	{
//		return '
//			<button class="success" id="'.$id.'" name="'.$id.'" >'.$message.'</button>
//		';
		return '
			<input class="success" type="submit" id="'.$id.'" name="'.$id.'" value="'.$message.'" >		
		';
	}
	
	public static function CreateDateInput($varname, $value, $span=null, $format=null, $isNormal=null)
	{
		if ($format = 'Y-m-d') $format = 'yyyy-mm-dd';
		//if ($format = 'd-m-Y') $format = 'mm-dd-yyyy';
		$format = $format ?  'data-format='.$format : '';
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
		'.$small1.'
		<div class="input-control text '.$span.'" data-role="datepicker" data-week-start="0" data-effect="fade" '.$format.'>
    	<input type="text" name="'.$varname.'" value= "'. $value .'" id="'.$varname.'">
    	<button class="btn-date" type="button"></button>
    	</div>
    	'.$small2.'
				';
	}
	
	public static function CreateSelect($varname, $value, $options, $span=null, $isNormal=null)
	{
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
		'.$small1.'
		<div class="input-control select '.$span.'">'.select_tag($varname, options_for_select($options, $value) ).'</div>
		'.$small2.'
		';
	}
	
	public static function CreateSelectMultiple($varname, $value, $options, $span=null, $isNormal=null)
	{
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
		'.$small1.'
		<div class="input-control select  '.$span.'">'.select_tag($varname, options_for_select($options, $value), array('multiple'=>true, 'size'=>'10') ).'</div>
		'.$small2.'
		';
	}
	
	public static function CreateSelectWithSerch($varname, $value, $options, $span=null)
	{
		$name = HrLib::CamelCase($varname);
		$id = 'search'.$name;
		$script = '
		<script type="text/javascript">
//		$(document).ready(function() {
//			$("#select").searchable();
//		});
		</script>
		<div class="input-control select '.$span.'">
			'.select_tag($varname, options_for_select($options, $value) ).'
		</div>
		<a href="#" id="'.$id.'" class="button default">'.$name.'</a>
		';
		return $script;
	}
	
	public static function CreateFileSelect($id, $span=null, $isNormal=null)
	{
		//var_dump(sfContext::getInstance()->getResponse()->getParameter('primary_ed'));
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		return '
			'.$small1.'
			<div class="input-control file '.$span.' ">
				<input id="'.$id.'" name="'.$id.'" type="file" placeholder="input '.$id.'"/>
				<button class="btn-file"></button>
			</div>
			'.$small2.'
		';
	}
	
	public static function CreateImageContainer($image, $message, $span=null)
	{
		//var_dump(sfContext::getInstance()->getResponse()->getParameter('primary_ed'));
		return $image;
		return '
			<div class="image-container shadow '.$span.' ">
			'. $image .'
			<div class="overlay-fluid">
			'. $message .'
			</div>
			</div>
		';
	}
	
	public static function CreateSelectActiveUser($varname, $value, $span=null, $isNormal=null)
	{
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		$activeUser = array('PARI'=>'PARI','MEIZHEN'=>'MEIZHEN', 'VELU'=>'VELU','HUIPING'=>'HUIPING','REYNAN'=>'REYNAN','REX'=>'REX','MELVIN'=>'MELVIN','TERENCE'=>'TERENCE','ADELINE'=>'ADELINE','NYOMAN'=>'NYOMAN','EMAN'=>'EMAN',);
		$activeUser = array_merge(array($value=>$value), $activeUser);
		return '
			'.$small1.'
			<div class="input-control select '.$span.'">'.select_tag($varname, options_for_select($activeUser, $value) ).'</select>
			'.$small2.'
		</div>	
			';
	}
	 	
	public static function CreateSelectCountry($city=null, $span=null, $isNormal=null)
	{
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		$city = $city? strtoupper($city): 'SG';
		$country = array(
				'AF'=>'Afghanistan',
				'AL'=>'Albania',
				'DZ'=>'Algeria',
				'AS'=>'American Samoa',
				'AD'=>'Andorra',
				'AO'=>'Angola',
				'AI'=>'Anguilla',
				'AQ'=>'Antarctica',
				'AG'=>'Antigua And Barbuda',
				'AR'=>'Argentina',
				'AM'=>'Armenia',
				'AW'=>'Aruba',
				'AU'=>'Australia',
				'AT'=>'Austria',
				'AZ'=>'Azerbaijan',
				'BS'=>'Bahamas',
				'BH'=>'Bahrain',
				'BD'=>'Bangladesh',
				'BB'=>'Barbados',
				'BY'=>'Belarus',
				'BE'=>'Belgium',
				'BZ'=>'Belize',
				'BJ'=>'Benin',
				'BM'=>'Bermuda',
				'BT'=>'Bhutan',
				'BO'=>'Bolivia',
				'BA'=>'Bosnia And Herzegovina',
				'BW'=>'Botswana',
				'BV'=>'Bouvet Island',
				'BR'=>'Brazil',
				'IO'=>'British Indian Ocean Territory',
				'BN'=>'Brunei',
				'BG'=>'Bulgaria',
				'BF'=>'Burkina Faso',
				'BI'=>'Burundi',
				'KH'=>'Cambodia',
				'CM'=>'Cameroon',
				'CA'=>'Canada',
				'CV'=>'Cape Verde',
				'KY'=>'Cayman Islands',
				'CF'=>'Central African Republic',
				'TD'=>'Chad',
				'CL'=>'Chile',
				'CN'=>'China',
				'CX'=>'Christmas Island',
				'CC'=>'Cocos (Keeling) Islands',
				'CO'=>'Columbia',
				'KM'=>'Comoros',
				'CG'=>'Congo',
				'CK'=>'Cook Islands',
				'CR'=>'Costa Rica',
				'CI'=>'Cote D\'Ivorie (Ivory Coast)',
				'HR'=>'Croatia (Hrvatska)',
				'CU'=>'Cuba',
				'CY'=>'Cyprus',
				'CZ'=>'Czech Republic',
				'CD'=>'Democratic Republic Of Congo (Zaire)',
				'DK'=>'Denmark',
				'DJ'=>'Djibouti',
				'DM'=>'Dominica',
				'DO'=>'Dominican Republic',
				'TP'=>'East Timor',
				'EC'=>'Ecuador',
				'EG'=>'Egypt',
				'SV'=>'El Salvador',
				'GQ'=>'Equatorial Guinea',
				'ER'=>'Eritrea',
				'EE'=>'Estonia',
				'ET'=>'Ethiopia',
				'FK'=>'Falkland Islands (Malvinas)',
				'FO'=>'Faroe Islands',
				'FJ'=>'Fiji',
				'FI'=>'Finland',
				'FR'=>'France',
				'FX'=>'France, Metropolitan',
				'GF'=>'French Guinea',
				'PF'=>'French Polynesia',
				'TF'=>'French Southern Territories',
				'GA'=>'Gabon',
				'GM'=>'Gambia',
				'GE'=>'Georgia',
				'DE'=>'Germany',
				'GH'=>'Ghana',
				'GI'=>'Gibraltar',
				'GR'=>'Greece',
				'GL'=>'Greenland',
				'GD'=>'Grenada',
				'GP'=>'Guadeloupe',
				'GU'=>'Guam',
				'GT'=>'Guatemala',
				'GN'=>'Guinea',
				'GW'=>'Guinea-Bissau',
				'GY'=>'Guyana',
				'HT'=>'Haiti',
				'HM'=>'Heard And McDonald Islands',
				'HN'=>'Honduras',
				'HK'=>'Hong Kong',
				'HU'=>'Hungary',
				'IS'=>'Iceland',
				'IN'=>'India',
				'ID'=>'Indonesia',
				'IR'=>'Iran',
				'IQ'=>'Iraq',
				'IE'=>'Ireland',
				'IL'=>'Israel',
				'IT'=>'Italy',
				'JM'=>'Jamaica',
				'JP'=>'Japan',
				'JO'=>'Jordan',
				'KZ'=>'Kazakhstan',
				'KE'=>'Kenya',
				'KI'=>'Kiribati',
				'KW'=>'Kuwait',
				'KG'=>'Kyrgyzstan',
				'LA'=>'Laos',
				'LV'=>'Latvia',
				'LB'=>'Lebanon',
				'LS'=>'Lesotho',
				'LR'=>'Liberia',
				'LY'=>'Libya',
				'LI'=>'Liechtenstein',
				'LT'=>'Lithuania',
				'LU'=>'Luxembourg',
				'MO'=>'Macau',
				'MK'=>'Macedonia',
				'MG'=>'Madagascar',
				'MW'=>'Malawi',
				'MY'=>'Malaysia',
				'MV'=>'Maldives',
				'ML'=>'Mali',
				'MT'=>'Malta',
				'MH'=>'Marshall Islands',
				'MQ'=>'Martinique',
				'MR'=>'Mauritania',
				'MU'=>'Mauritius',
				'YT'=>'Mayotte',
				'MX'=>'Mexico',
				'FM'=>'Micronesia',
				'MD'=>'Moldova',
				'MC'=>'Monaco',
				'MN'=>'Mongolia',
				'MS'=>'Montserrat',
				'MA'=>'Morocco',
				'MZ'=>'Mozambique',
				'MM'=>'Myanmar (Burma)',
				'NA'=>'Namibia',
				'NR'=>'Nauru',
				'NP'=>'Nepal',
				'NL'=>'Netherlands',
				'AN'=>'Netherlands Antilles',
				'NC'=>'New Caledonia',
				'NZ'=>'New Zealand',
				'NI'=>'Nicaragua',
				'NE'=>'Niger',
				'NG'=>'Nigeria',
				'NU'=>'Niue',
				'NF'=>'Norfolk Island',
				'KP'=>'North Korea',
				'MP'=>'Northern Mariana Islands',
				'NO'=>'Norway',
				'OM'=>'Oman',
				'PK'=>'Pakistan',
				'PW'=>'Palau',
				'PA'=>'Panama',
				'PG'=>'Papua New Guinea',
				'PY'=>'Paraguay',
				'PE'=>'Peru',
				'PH'=>'Philippines',
				'PN'=>'Pitcairn',
				'PL'=>'Poland',
				'PT'=>'Portugal',
				'PR'=>'Puerto Rico',
				'QA'=>'Qatar',
				'RE'=>'Reunion',
				'RO'=>'Romania',
				'RU'=>'Russia',
				'RW'=>'Rwanda',
				'SH'=>'Saint Helena',
				'KN'=>'Saint Kitts And Nevis',
				'LC'=>'Saint Lucia',
				'PM'=>'Saint Pierre And Miquelon',
				'VC'=>'Saint Vincent And The Grenadines',
				'SM'=>'San Marino',
				'ST'=>'Sao Tome And Principe',
				'SA'=>'Saudi Arabia',
				'SN'=>'Senegal',
				'SC'=>'Seychelles',
				'SL'=>'Sierra Leone',
				'SG'=>'Singapore',
				'SK'=>'Slovak Republic',
				'SI'=>'Slovenia',
				'SB'=>'Solomon Islands',
				'SO'=>'Somalia',
				'ZA'=>'South Africa',
				'GS'=>'South Georgia And South Sandwich Islands',
				'KR'=>'South Korea',
				'ES'=>'Spain',
				'LK'=>'Sri Lanka',
				'SD'=>'Sudan',
				'SR'=>'Suriname',
				'SJ'=>'Svalbard And Jan Mayen',
				'SZ'=>'Swaziland',
				'SE'=>'Sweden',
				'CH'=>'Switzerland',
				'SY'=>'Syria',
				'TW'=>'Taiwan',
				'TJ'=>'Tajikistan',
				'TZ'=>'Tanzania',
				'TH'=>'Thailand',
				'TG'=>'Togo',
				'TK'=>'Tokelau',
				'TO'=>'Tonga',
				'TT'=>'Trinidad And Tobago',
				'TN'=>'Tunisia',
				'TR'=>'Turkey',
				'TM'=>'Turkmenistan',
				'TC'=>'Turks And Caicos Islands',
				'TV'=>'Tuvalu',
				'UG'=>'Uganda',
				'UA'=>'Ukraine',
				'AE'=>'United Arab Emirates',
				'UK'=>'United Kingdom',
				'US'=>'United States',
				'UM'=>'United States Minor Outlying Islands',
				'UY'=>'Uruguay',
				'UZ'=>'Uzbekistan',
				'VU'=>'Vanuatu',
				'VA'=>'Vatican City (Holy See)',
				'VE'=>'Venezuela',
				'VN'=>'Vietnam',
				'VG'=>'Virgin Islands (British)',
				'VI'=>'Virgin Islands (US)',
				'WF'=>'Wallis And Futuna Islands',
				'EH'=>'Western Sahara',
				'WS'=>'Western Samoa',
				'YE'=>'Yemen',
				'YU'=>'Yugoslavia',
				'ZM'=>'Zambia',
				'ZW'=>'Zimbabwe'
				);
		
		$msg = '';
		$msg .= '
			'.$small1.'
			<div class="input-control select '.$span.'">
			'.$small2.'
			';
		$msg .= select_tag('country', options_for_select($country, $city), $span);
		$msg .= '</div>';
		return $msg;
	}
	
	
	public static function CreateSelectNationality($city=null, $span=null, $isNormal=null)
	{
		$small1 = "";
		$small2 = "";
		if (! $isNormal):
			$small1 = '<small>';
			$small2 = '</small>';
		endif;
		$city = $city? strtoupper($city): 'Singapore';
		$countries = array("Singapore","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
		$country = array();
		foreach($countries as $cntr):
			$country[$cntr] = $cntr;
		endforeach;
		$msg = '';
		$msg .= '
		'.$small1.'
		<div class="input-control select '.$span.'">
		'.$small2.'
		';
		$msg .= select_tag('nationality', options_for_select($country, $city), $span);
		$msg .= '</div>';
		return $msg;
	}
		
	public static function is_available($url, $timeout = 30) {
		$ch = curl_init(); // get cURL handle
	
		// set cURL options
		$opts = array(CURLOPT_RETURNTRANSFER => true, // do not output to browser
					  CURLOPT_URL => $url,            // set URL
					  CURLOPT_NOBODY => true, 		  // do a HEAD request only
					  CURLOPT_TIMEOUT => $timeout);   // set timeout
		curl_setopt_array($ch, $opts); 
	
		curl_exec($ch); // do it!
	
		$retval = curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200; // check if HTTP OK
	
		curl_close($ch); // close handle
	
		return $retval;
	}
	

	public static function GetNameToolTip($desc, $balloon)
	{
//		return '<a href="#" class="tt">'.$desc.'<span class="tooltip">
//			<span class="top"></span><span class="middle">
//			'.$balloon.'</span>
//			<span class="bottom"></span></span></a>';
		return '<a href="#"
			    data-hint="Title|<small>'.$balloon.'</small>"
			    data-hint-position="right">
			    '.$desc.'
			    </a>';
	}
	
	public static function GetColorList()
	{
		$colorList = array("#FF0F00", "#FF6600", "#FF9E01", "#FCD202", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000" );
	}
	
	public static function GetTeamList()
	{
		$teamList = array(
				            ''=>'---- MCS TEAMS ----',
				            'MICRONCLEAN ADMIN'=>'MICRONCLEAN ADMIN',
							'MCS SUPERVISOR'=>'MCS SUPERVISOR',
				            'MCS DRIVER'=>'MCS DRIVER',
							'MCS ONSITE'=>'MCS ONSITE',
				            'MCS SUPPORT'=>'MCS SUPPORT',
				            'MCS OTHER'=>'MCS OTHER',
							'MICRON ONSITE'=>'MICRON ONSITE',												
				            'SEAGATE ONSITE'=>'SEAGATE ONSITE',
							'SEAGATE OUTSIDE'=>'SEAGATE OUTSIDE',
							'SEAGATE SUPPORT'=>'SEAGATE SUPPORT',
							'SEAGATE SHOE PACKING'=>'SEAGATE SHOE PACKING',
				            'NUMONYX ONSITE'=>'NUMONYX ONSITE',
							'OPERATE MACHINE'=>'OPERATE MACHINE',
							'SHOWA ONSITE'=>'SHOWA ONSITE',
							'CUSTOMER SERVICE'=>'CUSTOMER SERVICE',
				            'IT'=>'IT',
				            'LABELING'=>'LABELING',
				            'DR'=>'DR',
							'QUALITY CONTROL'=>'QUALITY CONTROL',
							'SEAMSTRESS'=>'SEAMSTRESS',
				            'CLEANROOM PACKING'=>'CLEANROOM PACKING',
				            'INCOMING(SORTING JUMPSUIT)'=>'INCOMING(SORTING JUMPSUIT)',
				            'SHOE WASHING'=>'SHOE WASHING',
				            'SHOE PACKING'=>'SHOE PACKING',
							'OPERATE MACHINE'=>'OPERATE MACHINE',
				            'PACKING (JUMPSUIT)' =>'PACKING (JUMPSUIT)',
							'PACKING (MATCHING)' =>'PACKING (MATCHING)',
				            'SHOES VACUUM PACK'=>'SHOES VACUUM PACK',
				            'OUTSIDE SHOE PACKING'=>'OUTSIDE SHOE PACKING',
				            'QUALITY ASSURANCE'=>'QUALITY ASSURANCE',
							'HP ONSITE'=>'HP ONSITE',
				            'DRIVER'=>'DRIVER',
				            'MAINTENANCE'=>'MAINTENANCE',
							'UNIFORM'=>'UNIFORM',
							'PVA'=>'PVA',
				            ' '=>'---- ACRO TEAMS ----',				
							'STORE'=>'STORE', 
							'MEDIA & SUBSTRATE'=>'MEDIA & SUBSTRATE',
				            'SPOOL'=>'SPOOL',
				            'ACRO SUPERVISOR'=>'ACRO SUPERVISOR',
			                'HP'=>'HP',
				            'ACRO ADMIN'=>'ACRO ADMIN',
				            'CONVEYOR'=>'CONVEYOR',
                            'CASSETTE'=>'CASSETTE',
                            'SRT'=>'SRT',
				            'PVA'=>'PVA',
							'NANOCLEAN CHECK'=>'NANOCLEAN CHECK',
							'CLEANER'=>'CLEANER',
							'GUARD'=>'GUARD',
							'OTHERS'=>'OTHERS'
				            );
			return $teamList;
	}
	
	public static function CreateBackBanner($url=null, $msg1 = null, $msg2 = null)
	{
		return '<h1><a href="'.url_for($url).'"><i class="icon-arrow-left-3 fg-darker smaller"></i></a> '.$msg1.'<small> '.$msg2.'</small></h1>';
	}
	
	public static function xml_encode($mixed, $domElement=null, $DOMDocument=null) {
    if (is_null($DOMDocument)) {
        $DOMDocument =new DOMDocument;
        $DOMDocument->formatOutput = true;
        xml_encode($mixed, $DOMDocument, $DOMDocument);
        echo $DOMDocument->saveXML();
    }
    else {
        if (is_array($mixed)) {
            foreach ($mixed as $index => $mixedElement) {
                if (is_int($index)) {
                    if ($index === 0) {
                        $node = $domElement;
                    }
                    else {
                        $node = $DOMDocument->createElement($domElement->tagName);
                        $domElement->parentNode->appendChild($node);
                    }
                }
                else {
                    $plural = $DOMDocument->createElement($index);
                    $domElement->appendChild($plural);
                    $node = $plural;
                    if (!(rtrim($index, 's') === $index)) {
                        $singular = $DOMDocument->createElement(rtrim($index, 's'));
                        $plural->appendChild($singular);
                        $node = $singular;
                    }
                }

                xml_encode($mixedElement, $node, $DOMDocument);
            }
        }
        else {
            $mixed = is_bool($mixed) ? ($mixed ? 'true' : 'false') : $mixed;
            $domElement->appendChild($DOMDocument->createTextNode($mixed));
        }
    }
	}	
	
	public static function Showlog($mess, $name, $dt)
	{
		return '
			<a href="#" data-hint="Data Log | Modified By: '. $name .'<br> Date Modified: '.$dt.'" >' .$mess. '</a>
		';
	
	}
	
	
	public static function GetMonthList()
	{
		$month = array(
				''=>'SELECT MONTH',
				'JANUARY'=>'JANUARY',
				'FEBRUARY'=>'FEBRUARY',
				'MARCH'=>'MARCH',
				'APRIL'=>'APRIL',
				'MAY'=>'MAY',
				'JUNE'=>'JUNE',
				'JULY'=>'JULY',
				'AUGUST'=>'AUGUST',
				'SEPTEMBER'=>'SEPTEMBER',
				'OCTOBER'=>'OCTOBER',
				'NOVEMBER'=>'NOVEMBER',
				'DECEMBER'=>'DECEMBER',
		);
		return $month;
	}
	
	public static function GetWeekNoDay($year)
	{
		$start_date = $year . '/01/01';
		$end_date = $year . '/12/31';
		$current_date = strtotime($start_date);
	    $end_date = strtotime($end_date);
	    $out=array();
	    while($current_date<=$end_date){
	            $out[date("Y",$current_date)][date("F",$current_date)][date("W",$current_date)][]=date("D",$current_date);
	            $current_date=strtotime("+1 days",$current_date);
	    }
	    return $out;
	}	
	
	public static function GetWeekList($year)
	{
		$weeks = array('' => 'WEEK #');
		$weekno = self::getIsoWeeksInYear($year);
		for($x=1; $x <= $weekno; $x++):
			$weeks['W'. str_pad($x, 2, '0', STR_PAD_LEFT) ] = 'WEEK '. $x;
		endfor;
		return $weeks;
		//date('M d',strtotime('2013W15'));
	}
	
	public static function GetMonthListStardateKey($year)
	{
		$months = array(
			 $year .'-01-01' => 'January'
			,$year .'-02-01' => 'February'
			,$year .'-03-01' => 'March'
			,$year .'-04-01' => 'April'
			,$year .'-05-01' => 'May'
			,$year .'-06-01' => 'June'
			,$year .'-07-01' => 'July'
			,$year .'-08-01' => 'August'
			,$year .'-09-01' => 'September'
			,$year .'-10-01' => 'October'
			,$year .'-11-01' => 'January'
			,$year .'-12-01' => 'December' 
		);
		return $months;
	}
	
	public static function getIsoWeeksInYear($year) {
	    $date = new DateTime;
	    $date->setISODate($year, 53);
	    return ($date->format("W") === "53" ? 53 : 52);
	}
	
	public static function ShowReadableStory($story)
	{
		$storyArray = explode("\n", $story);
		$newstory = '';
		$count = 0;
		if (sizeof($storyArray) > 1):
			foreach($storyArray as $lines):
				if ($count >= 2):
					$count = 0;
					//$newstory .= "<br>";
				endif;
				$count ++;
				$newstory .= $lines;
			endforeach;
			return $newstory;
// 		else:
// 			return self::justify($story, 100);
		endif;
	}
	
	public static function vardump($msg)
	{
		echo '<pre>';
		print_r($msg);
		echo '</pre>';
		exit();
	}
	
	public static function justify($str, $maxlen) {
		$str = trim($str);
	
		$strlen = strlen($str);
		if ($strlen >= $maxlen) {
			$str = wordwrap($str, $maxlen);
			$str = explode("\n", $str);
			$str = $str[0];
			$strlen = strlen($str);
		}
	
		$space_count = substr_count($str, ' ');
		if ($space_count === 0) {
			return str_pad($str, $maxlen, ' ', STR_PAD_BOTH);
		}
	
		$extra_spaces_needed = $maxlen - $strlen;
		$total_spaces = $extra_spaces_needed + $space_count;
	
		$space_string_avg_length = $total_spaces / $space_count;
		$short_string_multiplier = floor($space_string_avg_length);
		$long_string_multiplier = ceil($space_string_avg_length);
	
		$short_fill_string = str_repeat(' ', $short_string_multiplier);
		$long_fill_string = str_repeat(' ', $long_string_multiplier);
	
		$limit = ($space_string_avg_length - $short_string_multiplier) * $space_count;
	
		$words_split_by_long = explode(' ', $str, $limit+1);
		$words_split_by_short = $words_split_by_long[$limit];
		$words_split_by_short = str_replace(' ', $short_fill_string, $words_split_by_short);
		$words_split_by_long[$limit] = $words_split_by_short;
	
		$result = implode($long_fill_string, $words_split_by_long);
	
		return $result;
	}
	
	public static function wysiwygFormat($text) {
		return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));
	}
	
	public static function wysiwygTextArea($text) {
		return strtr($text, array("\r\n" => '&#13;', "\r" => '&#13;', "\n" => '&#13;'));
	}
	
}
