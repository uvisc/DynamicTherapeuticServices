										<div class="row-fluid">
											<div class="span12">
												<div class="row-fluid detailHeader">
													<div class="span1" align="center">Edit</div>
													<div class="span3" align="left">Name</div>
													<div class="span2" align="left">Address</div>
													<div class="span2" align="left">Contact Info</div>
													<div class="span3" align="left">Therapist Info</div>
													<div class="span1" align="center">Del</div>
												</div>
<?php
	for($cntTherapists =0; $cntTherapists < count($getTherapistID); $cntTherapists++)
	{
		$getTherapistDetails = $therapistClass->getTherapistDetails($getTherapistID[$cntTherapists][0]);
?>
												<div class="row-fluid" style="border-bottom: 1px solid #000;">
													<div class="span1" align="center"><a href="updateTherapistInfo.php?TherapistID=<?php echo $getTherapistDetails[0][0] . $moreVar . "&page=" . $searchPage; ?>"><img src="images/edit.gif" border="0"></a></div>
													<div class="span3" align="left">
														<a href="therapistDetails.php?therapistID=<?php echo $getTherapistDetails[0][0] . $moreVar . "&page=" . $searchPage; ?>"><?php echo $getTherapistDetails[0][1] . " " . $getTherapistDetails[0][2]; ?></a>
														<br /><br />
														<strong>SSN</strong>: 
<?php
		if ($getTherapistDetails[0][3] != "")
		{
			$ssn_decoded = base64_decode($getTherapistDetails[0][3]);
							
			if(($_SESSION['GroupID'] == 1) || ($_SESSION['GroupID'] == 2) || ($_SESSION['GroupID'] == 10))  
			{ 
				echo substr($ssn_decoded, 0, 3) . "-" . substr($ssn_decoded, 3, 2) . "-" . substr($ssn_decoded, 5, 4); 
			} 
			else 
			{ 
				echo substr_replace($ssn_decoded, "xxx-xx-", 0, -4); 
			} 
		}														
?>
														<br /><br />
														<strong>DOB</strong>:
<?php
		if ($getTherapistDetails[0][41] != "")
		{
			echo date("j M Y", strtotime($getTherapistDetails[0][41]));
		}
?>	
														<br /><br />
														<strong>Contacted Through</strong>:								
<?php
		if ($getTherapistDetails[0][41] == "")
		{
			echo "N/A";
		}
		else
		{
			echo $getTherapistDetails[0][41];
		}		
?>														
														<br /><br />
														<strong>Agency Name</strong>:
<?php
		if ($getTherapistDetails[0][42] == "")
		{
			echo "N/A";
		}
		else
		{
			echo $getTherapistDetails[0][42];
		}
?>		
														<br /><br /><br /><br />
													</div>
													<div class="span2" align="left">
														<span align="center">
<?php
		if($getTherapistDetails[0][18] != "")
		{
?>
														
															<img src="<?php echo $getTherapistDetails[0][18]; ?>" width="100" height="100" border="0">				
															<br>
															<a href="deleteTherapistPics.php?TherapistID=<?php echo $getTherapistDetails[0][0]; ?>&PicName=<?php echo $getTherapistDetails[0][18]; ?>"><strong>Delete</strong></a>
<?php
		} 
		else
		{
?>
															<img src="images/noPic.png" width="50" height="50" border="0">
<?php
		}
?>
														<br><br>
														</span>
<?php
		echo $getTherapistDetails[0][4] . ",<br />" . $getTherapistDetails[0][5] . ",<br />" . $getTherapistDetails[0][40] . " - " . $getTherapistDetails[0][6] . "<br /><br />";	
?>
														<strong>Borough: </strong><?php echo $getTherapistDetails[0][8]; ?><br><br>
														<strong>County: </strong><?php echo $getTherapistDetails[0][9]; ?><br><br>
														<strong>Travel Zone: </strong><?php echo $getTherapistDetails[0][29]; ?><br><br>
                    									<strong>Servicing State: </strong>
<?php
		$cntServicingState = $therapistClass->cntServicingState($getTherapistDetails[0][0]);
		
		if ($cntServicingState > 0)
		{
			$getServicingState = $therapistClass->getServicingState($getTherapistDetails[0][0]);

			for ($cntServiceState=0; $cntServiceState< count($getServicingState); $cntServiceState++)
        	{
                if ($cntServiceState == 0)
                {
                	echo $getServicingState[$cntServiceState][0];
                }
                else
                {
                    echo ", " . $getServicingState[$cntServiceState][0];
                }   
            }
        }
        else
        {
        	echo " - ";
        }
?>                    									
													</div>
													<div class="span2" align="left">
														<strong>Home: </strong><?php echo formatPhoneDisplay($getTherapistDetails[0][10]); ?><br><br>
														<strong>Cell: </strong>
<?php 
		echo formatPhoneDisplay($getTherapistDetails[0][11]);

		if (($getTherapistDetails[0][11] != "") && ($getTherapistDetails[0][43] != ""))
		{
			echo "<br /><a href='#' onclick='openTextMsgBox(" . $getTherapistDetails[0][0] . "); return false;'>" . $getTherapistDetails[0][11] . $getTherapistDetails[0][43] . "</a>";
?>
														<input type="hidden" name="therapistCell<?php echo $getTherapistDetails[0][0]; ?>" id="therapistCell<?php echo $getTherapistDetails[0][0]; ?>" value="<?php echo $getTherapistDetails[0][11] . $getTherapistDetails[0][43];?>"/>
<?php			
		}
?>
														<br><br>
														<strong>Business: </strong><?php echo formatPhoneDisplay($getTherapistDetails[0][13]); ?><br><br>
														<strong>Fax: </strong><?php echo formatPhoneDisplay($getTherapistDetails[0][14]); ?><br><br>
														<strong>Email: </strong><?php echo $getTherapistDetails[0][15]; ?><br><br>
														<strong>Secondary Email: </strong><?php echo $getTherapistDetails[0][16]; ?><br><br>
														<strong>Skype: </strong><?php echo $getTherapistDetails[0][38]; ?><br><br>
													</div>
													<div class="span3" align="left">
														<strong>Type: </strong><?php echo $getTherapistDetails[0][21]; ?><br><br>
														<strong>Hourly Rate: </strong><?php echo formatRateDisplay($getTherapistDetails[0][22]); ?><br><br>
														<strong>EI Rate: </strong><?php echo formatRateDisplay($getTherapistDetails[0][23]); ?><br><br>
														<strong>Auto Accept: </strong>
<?php
		if ($getTherapistDetails[0][37] != 0)
		{
			echo "<img src=images/greenCheck.jpg width=20 height=20>";
		}
		else
		{
			echo "<img src=images/redX.jpg width=20 height=20>";
		}
?>														
														<br><br>
														<strong>Covansys Approval: </strong>
<?php
		$cntCovansysApproval = $therapistClass->cntCovansysApproval($getTherapistDetails[0][0]);
		
		if ($cntCovansysApproval > 0)
		{
			echo "<img src=images/greenCheck.jpg width=20 height=20>";
        }
        else
        {
        	echo "<img src=images/redX.jpg width=20 height=20>";
        }
?>		
														<br><br>
														<strong>Tax Status: </strong><?php echo $getTherapistDetails[0][24]; ?><br><br>
														<strong>Availability: </strong>
<?php 
		echo $getTherapistDetails[0][25]; 
		$moreAvail = "";

		$cntTherapistAvailability = $therapistClass->cntTherapistAvailability($getTherapistDetails[0][0]);
		
		if ($cntTherapistAvailability > 0)
		{
			$getTherapistAvailability = $therapistClass->getTherapistAvailability($getTherapistDetails[0][0]);

			for ($cntTherapistAvailable=0; $cntTherapistAvailable< count($getTherapistAvailability); $cntTherapistAvailable++)
        	{
            	if ($getTherapistAvailability[$cntTherapistAvailable][0] == "1")    
            	{
            		$cntTimePeriod = $therapistClass->cntTimePeriod($getTherapistAvailability[$cntTherapistAvailable][1]);

            		if ($cntTimePeriod > 0)
            		{
            			$getTimePeriod = $therapistClass->getTimePeriod($getTherapistAvailability[$cntTherapistAvailable][1]);

            			$moreAvail .= '<p style="padding-left:10px;">' . $getTimePeriod[0][0] . '</p>';
            		}
            	}

            	if ($getTherapistAvailability[$cntTherapistAvailable][2] == "1")    
            	{
            		$cntTimePeriod = $therapistClass->cntTimePeriod($getTherapistAvailability[$cntTherapistAvailable][3]);

            		if ($cntTimePeriod > 0)
            		{
            			$getTimePeriod = $therapistClass->getTimePeriod($getTherapistAvailability[$cntTherapistAvailable][3]);

            			$moreAvail .= '<p style="padding-left:10px;">' . $getTimePeriod[0][0] . ' school year</p>';
            		}
            	}

            	if ($getTherapistAvailability[$cntTherapistAvailable][4] == "1")    
            	{
            		$cntTimePeriod = $therapistClass->cntTimePeriod($getTherapistAvailability[$cntTherapistAvailable][5]);

            		if ($cntTimePeriod > 0)
            		{
            			$getTimePeriod = $therapistClass->getTimePeriod($getTherapistAvailability[$cntTherapistAvailable][5]);

            			$moreAvail .= '<p style="padding-left:10px;">' . $getTimePeriod[0][0] . ' for EI</p>';
            		}
            	}
            }
        }

        if ($moreAvail != "")
        {
        	echo "<br /><p style='padding-left:10px;'>Available in: </p>" . $moreAvail;
        }
        else
        {
        	echo "<br />";
        }
?>
														<br>
														<strong>Trainings Attended: </strong>
<?php 
		$cntTrainingsAttended = $therapistClass->cntTrainingsAttended($getTherapistDetails[0][0]);
		
		if ($cntTrainingsAttended > 0)
		{
			echo "<br />";

			$getTrainingsAttended = $therapistClass->getTrainingsAttended($getTherapistDetails[0][0]);

			for ($cntTrainingAttended=0; $cntTrainingAttended< count($getTrainingsAttended); $cntTrainingAttended++)
        	{
                if ($cntTrainingAttended == 0)
                {
                	echo '<p style="padding-left:10px;">' . $getTrainingsAttended[$cntTrainingAttended][0] . " <b>on</b> " . formatDateDisplay($getTrainingsAttended[$cntTrainingAttended][1]) . '</p>';
                }
                else
                {
                    echo '<p style="padding-left:10px;">' . $getTrainingsAttended[$cntTrainingAttended][0] . " <b>on</b> " . formatDateDisplay($getTrainingsAttended[$cntTrainingAttended][1]) . '</p>';
                }   
            }
        }
        else
        {
        	echo " - ";
        }
?>
													</div>
													<div class="span1" align="center">
<?php
		if($_SESSION['GroupID'] == 1) 
		{
			$cntActiveJobs = $jobsClass->cntActiveJobs($getTherapistDetails[0][0]);

			if ($cntActiveJobs < 1)
			{
?>
														<img src="images/delete.gif" border="0" onclick="deleteThera(<?php echo $getTherapistDetails[0][0]; ?>)" />
														<form name="deleteTherapist<?php echo $getTherapistDetails[0][0]; ?>" id="deleteTherapist<?php echo $getTherapistDetails[0][0]; ?>" action="deleteTherapist.php" method="POST">
															<input type="hidden" name="parameterPassed" id="parameterPassed<?php echo $getTherapistDetails[0][0]; ?>" value="<?php echo $moreVar; ?>" />
															<input type="hidden" name="therapistID" id="therapistID<?php echo $getTherapistDetails[0][0]; ?>" value="<?php echo $getTherapistDetails[0][0]; ?>" />
														</form>
<?php		
			}	
		}
		else
		{
			echo '&nbsp';
		}
?>													
													</div>
												</div>
<?php
	}
?>
											</div>
										</div>

										<div id="textMsgDialogForm" title="Send Text Message">
											<p class="validateTips"></p>
											<form>
												<fieldset>
													<label for="msgUserEmail">Cell:</label>
													<input type="text" name="msgUserEmail" id="msgUserEmail" readonly class="text ui-widget-content ui-corner-all" />
													<label for="textMsg">Text Message:</label>
													<textarea name="textMsg" id="textMsg" class="text ui-widget-content ui-corner-all" rows="5" cols="30"></textarea>
												</fieldset>
											</form>
										</div>

										<div id="confirmationMessage" title="Confirmation Screen">
											<p></p>
											<p id="confirmationMsg"></p>
										</div>