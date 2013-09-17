<?php
	//session_start();
	$pageTitle = "Login";

	include_once('include/header.php');

	$errorMsg = "";

	$userUserName = $userClass->getUserName($_GET['userID']);

	if (isset($_POST['resetPwd']) && ($_POST['resetPwd'] == "Reset Password"))
	{
		$updPassword = $userClass->updPassword($_POST['newPassword'], $_GET['userID']);

		$userLogin = $userClass->getUserLogin($userUserName[0][0], $_POST['newPassword']);

		$newArr = array_filter($userLogin);
        if (!empty($newArr))
        {
        	//session_register('UserID'); 
			$_SESSION['UserID'] = $userLogin[0][0];
			//session_register('UserFullName'); 
			$_SESSION['UserFullName'] = $userLogin[0][1] . " " . $userLogin[0][2];
			//session_register('UserPic'); 
			$_SESSION['UserPic'] = $userLogin[0][4];
			//session_register('GroupID'); 
			$_SESSION['GroupID'] = $userLogin[0][5];
			//session_register('GroupName'); 
			$_SESSION['GroupName'] = $userLogin[0][8];
			//session_register('UserGroupID'); 
			$_SESSION['UserGroupID'] = $userLogin[0][7];
			//session_register('TherapistID'); 
			if ($userLogin[0][5] == 4)
			{
				$_SESSION['TherapistID'] = $userLogin[0][6];
			}
			else
			{
				$_SESSION['TherapistID'] = 0;	
			}
		}

		$errorMsg = "Your password has been updated successfully. Please wait. You will be re-directed now.";

		header("Refresh: 5; url=admin.php");
	}
?>
					<div class="row-fluid">
						<div class="container">
							<div class="row-fluid navbar">
								<div class="span12" align="center">
									<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Online Portal Reset Password</a>
								</div>
							</div>
							<div class="row-fluid" align="center">
								<div class="span11 text-center" align="center">	
									<form name="frmResetPwd" method="post" action="" onsubmit="return validateResetPwdForm()">
										<table border="1" align="center" width="50%" cellpadding="3" cellspacing="0" bordercolor="#FF9900">
											<tr>
												<td align="center">
													<table width="100%" border="0" cellspacing="2" cellpadding="2">
														<tr bgcolor="#FF9900"> 
															<td colspan="2"> 
																<span class="login">Reset Password</span>
															</td>
														</tr>
														<tr> 
															<td colspan="2" align="center">
																<span class="errorMessage" id="errMsg"><?php echo $errorMsg; ?></span>
															</td>
														</tr>
														<tr> 
															<td>
																<span class="loginDetail">Username :</span>
															</td>
															<td>
																<?php echo $userUserName[0][0]; ?>
																<input type="hidden" name="tmpPassword" id="tmpPassword" value="<?php echo $userUserName[0][1]; ?>" />
															</td>
														</tr>
														<tr> 
															<td>
																<span class="loginDetail">Current Password :</span>
															</td>
															<td>
																<input type="password" name="currentPassword" id="currentPassword" value="" />
															</td>
														</tr>
														<tr> 
															<td>
																<span class="loginDetail">New Password :</span>
															</td>
															<td>
																<input type="password" name="newPassword" id="newPassword" value="" />
															</td>
														</tr>
														<tr> 
															<td>
																<span class="loginDetail">Re-enter Password :</span>
															</td>
															<td>
																<input type="password" name="newPassword1" id="newPassword1" value="" />
															</td>
														</tr>
														<tr align="right"> 
															<td colspan="2" align="center"><input type="submit" name="resetPwd" value="Reset Password" /></td>
														</tr>
														<tr align="right"> 
															<td colspan="2" align="right"><br /><a href="index.php" style="font-weight:bold">Back to Login Screen</a>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<input type="hidden" name="loginID" id="loginID" value="<?php echo $_GET['loginID']; ?>"  />
									</form>
								</div>
							</div>		
						</div>
					</div>
<?php
	include_once('include/footer.php');
?>		