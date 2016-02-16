    
        <div class="page-region">
            <div class="page-region-content">
                <div class="span12">
                    <h2>LECTURE SLIDES</h2>
                    <?php
						$location = getcwd() . '/docs';
						$fnameList = array();
						$ignorefileList = array('.', '..');
						 if ($handle = opendir($location)) {
						   //var_dump($handle);
						   while (false !== ($file = readdir($handle))) {
						          if (!  in_array($file, $ignorefileList) ) {						            
										//$thelist .= '<li><a href="'.$file.'">'.$file.'</a></li>';
										$fnameList[] =  $file; 

						          }
						       }
						  closedir($handle);
						  }
						  
						  asort($fnameList);
						  echo '<table class="bordered condensed table striped" >';
						  foreach($fnameList as $file):
							  echo '<tr><td>
                                	<a href="docs/'. $file.'" target="_BLANK"><i class="icon-pdf "></i> '.$file.'</a>
                            		</td></tr>
						  			';
						  endforeach;
						  echo '</table>';
					?>
</div>
</div>
</div>
</div>