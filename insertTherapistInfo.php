<?php
	$pageTitle = "Add New Therapist";

	$errorMsg = "";

	include_once('include/header.php');

	if (isset($_POST['Submit']) && ($_POST['Submit'] == "Change Password"))
	{
		$getCurrentPwd = $userClass->getCurrentPassword();

		if ($getCurrentPwd[0][0] == $_POST['frmCurrentPassword'])
		{
			$updPassword = $userClass->updPassword($_POST['frmNewPassword']);

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
										<a href="#" class="brand">Insert Therapist</a>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<form name="addTherapist" id="addTherapist" action="" onsubmit="return validateAddTherapistForm()" method="POST">
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
																	<span class="loginDetail">First Name :</span>
																</td>
																<td><input name="frmFirstName" id="frmFirstName" type="text" value="" /></td>
															</tr>
															<tr> 
																<td><span class="loginDetail">Last Name :</span></td>
																<td><input name="frmLastName" type="text" id="frmLastName" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">SSN :</span></td>
																<td><input name="frmSSN" type="text" id="frmSSN" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">DOB :</span></td>
																<td><input name="frmDOB" type="text" id="frmDOB" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">State :</span></td>
																<td>
																	<select name="frmState" id="frmState">
																		<option value="">----Select a State----</option>
																	</select>
																</td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Zone/Borough :</span></td>
																<td><input name="frmZone" type="text" id="frmZone" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">County :</span></td>
																<td><input name="frmCounty" type="text" id="frmCounty" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">City :</span></td>
																<td><input name="frmCity" type="text" id="frmCity" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Zip :</span></td>
																<td><input name="frmZip" type="text" id="frmZip" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Address :</span></td>
																<td><input name="frmAddress" type="text" id="frmAddress" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Home Phone :</span></td>
																<td><input name="frmHomePhone" type="text" id="frmHomePhone" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Cell Phone :</span></td>
																<td><input name="frmCellPhone" type="text" id="frmCellPhone" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Cell Type :</span></td>
																<td>
																	<select name="frmCellType" id="frmCellType">
																		<option value="">----Select a Cell Type----</option>
																	</select>
																</td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Business Phone :</span></td>
																<td><input name="frmBusinessPhone" type="text" id="frmBusinessPhone" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Fax# :</span></td>
																<td><input name="frmFax" type="text" id="frmFax" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Skype ID :</span></td>
																<td><input name="frmSkype" type="text" id="frmSkype" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Email :</span></td>
																<td><input name="frmEmail" type="text" id="frmEmail" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Secondary Email :</span></td>
																<td><input name="frmSecondaryEmail" type="text" id="frmSecondaryEmail" value="" /></td>
															</tr>
															<tr> 
																<td valign="middle"><span class="loginDetail">Deactivate Email :</span></td>
																<td><input name="frmDeactivateEmail" type="checkbox" id="frmDeactivateEmail" value="" /></td>
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