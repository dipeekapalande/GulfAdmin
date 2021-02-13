<?php

require_once('..\config\config.php');

$id    = $_REQUEST['listcam'];


$response="";

						
					
							$response.="<input type='button' name='del_item' value='Delete' onClick='deleteRow();' class='btn btn-danger'/>
							<div id='myItemListold'>
								<ul style='list-style:none'>
									";
									foreach($id  as $ca)
									{
										 $filtercamel = ['_id' => new MongoDB\BSON\ObjectID($ca)];

										  $optionscamel = [];

										  $querycamel = new MongoDB\Driver\Query($filtercamel,$optionscamel);

										  $cursorcamel = $connection->executeQuery('gulf_racing.camels', $querycamel);
										  foreach($cursorcamel as $cucam)
											{
										
										$response.="<DIV class='camelitem float-clear' style='clear:both;margin-top:2%'><DIV class='col-sm-1' style=''><input type='checkbox' class='cameldeleteclass' name='cameldelete[]' value=".$cucam->_id."></DIV><li>".$cucam->camelname." - ".$cucam->camelnumber." &nbsp;&nbsp;&nbsp;</li></DIV>";
										
											}
									}
									
								$response.="</ul>
							</div>";
							
							echo $response;
							exit;
							
						


