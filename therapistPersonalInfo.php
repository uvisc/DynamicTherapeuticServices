<?php
	$pageTitle = "Personal Information";

	$errorMsg = "";

	include_once('include/header.php');

	$userProfile = $userClass->getUserProfile();
?>
						<div class="row-fluid">
<?php	

	if ($maintenancePeriod[0][0] == "Y")
	{
?>							<div class="hero-unit">
								<div class="container">
									<h1>Alert/Notification</h1>
									<p class="lead">System down or any related notification.</p>
								</div>
							</div>
<?php
	}
	//A.FirstName, A.LastName, A.Address, A.City, B.StateName, A.County, A.Zip, A.Email, A.SecondaryEmail, A.PicName, A.PicUrl, A.HomePhone, A.CellPhone

	if ($userProfile[0][10] != "")
	{
		$userImg = $userProfile[0][10];
	}
	else
	{
		$userImg = "images/user.png";
	}

	if ($userProfile[0][2] != "")
	{
		$userAddress = $userProfile[0][2] . ", <br>";
	}

	if ($userProfile[0][3] != "")
	{
		$userAddress .= $userProfile[0][3] . " ";
	}

	if ($userProfile[0][4] != "")
	{
		$userAddress = $userProfile[0][4] . "<br>";
	} 

	if ($userProfile[0][5] != "")
	{
		$userAddress = $userProfile[0][5] . "<br>";
	} 

	if ($userProfile[0][6] != "")
	{
		$userAddress = $userProfile[0][6];
	}
?>
							<div class="span12">
								<div class="row-fluid navbar">
									<div class="span12" align="left">
										<a href="#" class="brand">Personal Information</a>
									</div>
								</div>
								<div class="row-fluid navbar">
									<div class="span12" align="center">
										<span id="showMsg" name="showMsg"></span>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span4">
										&nbsp;
									</div>
									<div class="span4 tableBorderOrange">	
										<div class="row-fluid">
											<div class="span6">
												<img src="<?php echo $userImg; ?>" border="0" alt="<?php echo $userProfile[0][9]; ?>" />
											</div>
											<div class="span6">
												<div class="row-fluid">
													<?php echo $userProfile[0][0] . " " . $userProfile[0][1]; ?>
												</div>
												<div class="row-fluid">
													<?php echo $userAddress; ?>
												</div>
											</div>
										</div>
										<div class="row-fluid offset1">
											<span class="contactDetail">Contact Details: </span><br />
											<?php 
												echo "Email: " . $userProfile[0][7] . "<br>";

												if ($userProfile[0][8] != "")
												{
													echo "Secondary Email: " . $userProfile[0][8] . "<br />";
												}

												if ($userProfile[0][9] != "")
												{
													echo "Home Phone: " . $userProfile[0][9] . "<br>";
												}

												if ($userProfile[0][10] != "")
												{
													echo "Cell Phone: " . $userProfile[0][10] ; 
												}
											?>
										</div>
								    </div>
								    <div class="span4">
										&nbsp;
									</div>    
								</div>
<?php
	//if ($_SESSION['GroupID'] == 4)
	//{
?>	
								<div class="row-fluid">
									<div class="span12" align="right">
										<a href="#" onclick="openEmail()">Click here</a> if your information is not correct
									</div>
									<div id="dialog-form" title="Contact Us">
										<p class="validateTips">All form fields are required.</p>
										<form>
											<fieldset>
												<label for="msgSubject">Subject</label>
												<input type="text" name="msgSubject" id="msgSubject" class="text ui-widget-content ui-corner-all" value="Incorrect personal details" />
												<input type="hidden" name="msgUserName" id="msgUserName" value="<?php echo $_SESSION['UserFullName']; ?>" />
												<input type="hidden" name="msgUserEmail" id="msgUserEmail" value="<?php echo $userProfile[0][7]; ?>" />
												<label for="msgDesc">Message</label>
												<textarea name="msgDesc" id="msgDesc" class="text ui-widget-content ui-corner-all" rows="5" cols="40"></textarea>
											</fieldset>
										</form>
									<div>
								</div>
<?php
	//}
?>
							</div>
						</div>
<?php
	include_once('include/footer.php');
?>		