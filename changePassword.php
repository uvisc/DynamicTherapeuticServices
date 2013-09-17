<?php
	$pageTitle = "Change Password";

	$errorMsg = "";

	include_once('include/header.php');

	if (isset($_POST['Submit']) && ($_POST['Submit'] == "Change Password"))
	{
		$getCurrentPwd = $userClass->getCurrentPassword();

		if ($getCurrentPwd[0][0] == $_POST['frmCurrentPassword'])
		{
			$updPassword = $userClass->updPassword($_POST['frmNewPassword'], $_SESSION['UserID']);

			if ($updPassword)
			{
				$errorMsg = "The password has been updated successfully. You will be logged out now. Please use your new password to log back in.";	
				echo '<META http-equiv="refresh" content="5;URL=logout.php">';	
			}
		}
		else
		{
			$errorMsg = "The current password entered does not match the one on file.";
		}
	}
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
?>
							<div class="span12">
								<div class="row-fluid navbar">
									<div class="span12" align="left">
										<a href="#" class="brand">Change your Password</a>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<form name="chanegPwd" id="changePwd" action="" onsubmit="return validatePwdForm()" method="POST">
											<table border="1" align="center" width="40%" cellpadding="3" cellspacing="0" bordercolor="#FF9900">
												<tr>
													<td align="center">
														<table width="100%" border="0" cellspacing="2" cellpadding="2">
															<tr> 
																<td colspan="2" align="center">
																	<span class="errorMessage" id="errMsg"><?php echo $errorMsg; ?></span>
																</td>
															</tr>
															<tr> 
																<td>
																	<span class="loginDetail">Current Password :</span>
																</td>
																<td><input name="frmCurrentPassword" id="frmCurrentPassword" type="password" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">New Password :</span></td>
																<td><input name="frmNewPassword" type="password" id="frmNewPassword" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Re-enter Password :</span></td>
																<td><input name="frmNewPassword1" type="password" id="frmNewPassword1" value="" /></td>
															</tr>
															<tr align="right"> 
																<td colspan="2" align="center"><input type="submit" name="Submit" value="Change Password" /></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</form>
								    </div>    
								</div>
							</div>
						</div>
<?php
	include_once('include/footer.php');
?>		