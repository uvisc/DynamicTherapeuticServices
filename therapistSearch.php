<?php
	$getTherapistType = $therapistClass->getTherapistType('');

	$getTherapistState = $therapistClass->getTherapistState('');

	$getTherapistReqDoc = $therapistClass->getTherapistReqDoc('');
?>
										<div class="row-fluid">
											<div class="span1" align="center">	
												&nbsp;
											</div>
											<div class="span10 searchForm" align="center">	
												<form name="therapistSearch" id="therapistSearch" method="POST" action="">
													<div class="row-fluid">
														<div class="span12 text-right">
															<a href="listTherapistInfo.php">Reset Search</a>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span2 text-right">
															Search :
														</div>
														<div class="span4 text-left">
															<input type="text" name="searchGeneric" id="searchGeneric" placeholder="Search by First or Last name" value="<?php echo $searchGeneric; ?>" />
														</div>
														<div class="span2 text-right">
															By Status :
														</div>
														<div class="span4 text-left">
															<select name="searchStatus" id="searchStatus" class="filterDropDown">
																<option value="" selected>Search By Status</option>
																<option value="1" <?php if ($searchStatus == "1") { echo "selected"; } ?>>Active</option>
																<option value="2" <?php if ($searchStatus == "2") { echo "selected"; } ?>>In-active</option>
																<option value="3" <?php if ($searchStatus == "3") { echo "selected"; } ?>>Auto-accept</option>
																<option value="4" <?php if ($searchStatus == "4") { echo "selected"; } ?>>Non Auto-accept</option>
															</select>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span2 text-right">
															Zip :
														</div>
														<div class="span4 text-left">
															<input type="text" name="searchZip" id="searchZip" placeholder="Search by Therapist Zip" value="<?php echo $searchZip; ?>" />
														</div>
														<div class="span2 text-right">
															Therapist Type :
														</div>
														<div class="span4 text-left">
															<select name="searchTherapistType" id="searchTherapistType" class="filterDropDown">
																<option value="" selected>Search By Therapist Type</option>
<?php
	for($i=0; $i < count($getTherapistType); $i++)
	{
?>		
																<option value="<?php echo $getTherapistType[$i][0]; ?>" <?php if ($searchTherapistType == $getTherapistType[$i][0]) { echo "selected"; } ?>><?php echo $getTherapistType[$i][1]; ?></option>	
<?php
	}
?>
															</select>
														</div>
													</div>
													<div class="row-fluid">
													<div class="span2 text-right">
																State :
														</div>
														<div class="span3 text-left">
															<select name="searchState" id="searchState" class="filterDropDown">
																<option value="" selected>Search By State</option>
<?php
	for($i=0; $i < count($getTherapistState); $i++)
	{
?>		
																<option value="<?php echo $getTherapistState[$i][0]; ?>" <?php if ($searchState == $getTherapistState[$i][0]) { echo "selected"; } ?>><?php echo $getTherapistState[$i][1] . " - " . $getTherapistState[$i][2]; ?></option>	
<?php
	}	
?>															
															</select>
															<input type="hidden" name="getBorough" id="getBorough" value="<?php echo $searchBorough; ?>" />
															<input type="hidden" name="getCounty" id="getCounty" value="<?php echo $searchCounty; ?>" />
														</div>
														<div class="span3 text-right">
															Borough :
														</div>
														<div class="span4 text-left">
															<select name="searchBorough" id="searchBorough" class="filterDropDown">
																<option value="" selected>Search By Borough</option>
															</select>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span2 text-right">
															County :
														</div>
														<div class="span3 text-left">
															<select name="searchCounty" id="searchCounty" class="filterDropDown">
																<option value="" selected>Search By County</option>
															</select>
														</div>
														<div class="span3 text-right">
															Required Document :
														</div>
														<div class="span4 text-left">
															<select name="searchReqDoc" id="searchReqDoc" class="filterDropDown">
																<option value="" selected>Search By Required Document</option>
<?php
	for($i=0; $i < count($getTherapistReqDoc); $i++)
	{
?>		
																<option value="<?php echo $getTherapistReqDoc[$i][0]; ?>" <?php if ($searchReqDoc == $getTherapistReqDoc[$i][0]) { echo "selected"; } ?>><?php echo $getTherapistReqDoc[$i][1]; ?></option>	
<?php
	}	
?>																	
															</select>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span12 text-center">
															<input type="submit" name="submitTherapistSearch" id="submitTherapistSearch" value="Search Therapist" />
														</div>
													</div>
												</form>
											</div>
											<div class="span1" align="center">	
												&nbsp;
											</div>
										</div>