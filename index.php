<?php
	//session_start();
	$pageTitle = "Login";

	include_once('include/header.php');

	if (isset($_POST['Submit']) && ($_POST['Submit'] == "Login Now"))
	{
		$cntUserLogin = $userClass->cntUserLogin($_POST['frmUsername'], $_POST['frmPassword']);
		//echo "!!!" . $cntUserLogin;

		if ($cntUserLogin > 0)
		{
			$userLogin = $userClass->getUserLogin($_POST['frmUsername'], $_POST['frmPassword']);

			$newArr = array_filter($userLogin);
        	if (!empty($newArr))
        	{
        		session_register('UserID'); 
				$_SESSION['UserID'] = $userLogin[0][0];
				session_register('UserFullName'); 
				$_SESSION['UserFullName'] = $userLogin[0][1] . " " . $userLogin[0][2];
				session_register('UserPic'); 
				$_SESSION['UserPic'] = $userLogin[0][4];
				session_register('GroupID'); 
				$_SESSION['GroupID'] = $userLogin[0][5];
				session_register('GroupName'); 
				$_SESSION['GroupName'] = $userLogin[0][8];
				session_register('UserGroupID'); 
				$_SESSION['UserGroupID'] = $userLogin[0][7];
				session_register('TherapistID'); 
				if ($userLogin[0][5] == 4)
				{
					$_SESSION['TherapistID'] = $userLogin[0][6];
				}
				else
				{
					$_SESSION['TherapistID'] = 0;	
				}

				if($_POST['loginID'] != "")
				{
					$getRedirectFile = $userClass->getRedirectFile($_POST['loginID']);

					$newRedirect = array_filter($getRedirectFile);
        			if (!empty($newRedirect))
        			{
        				$redirectFile = "Location: " . $getRedirectFile[0][0];	
        			}
        			else
        			{
        				$redirectFile = "Location: admin.php";
        			}
				}
				else
				{
					$redirectFile = "Location: admin.php";
				}
				
				header($redirectFile);
			}	
		}
		else
		{
			$errorMsg = "Incorrect username or password.";
			$userName = $_POST['frmUsername'];
			$userPwd = $_POST['frmPassword'];
		}
	}
	else
	{
		$userName = "";
		$userPwd = "";
		$errorMsg = "";
	}

	if ($maintenancePeriod[0][0] == "Y")
	{
?>
					<div class="row-fluid">
						<div class="hero-unit">
							<div class="container">
								<h1>Alert/Notification</h1>
								<p class="lead">System down or any related notification.</p>
							</div>
						</div>
					</div>
<?php
	}
	else
	{
?>
					<br /><br /><br /><br /><br />
<?php
	}
?>
					<div class="row-fluid">
						<div class="container">
							<div class="row-fluid navbar">
								<div class="span12" align="center">
									<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Online Portal</a>
								</div>
							</div>
							<div class="row-fluid" align="center">
								<div class="span11 text-center" align="center">	
									<form name="frmAccountLogin" method="post" action="" onsubmit="return validateLoginForm()">
										<table border="1" align="center" width="30%" cellpadding="3" cellspacing="0" bordercolor="#FF9900">
											<tr>
												<td align="center">
													<table width="100%" border="0" cellspacing="2" cellpadding="2">
														<tr bgcolor="#FF9900"> 
															<td colspan="2"> 
																<span class="login">Account Login</span>
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
															<td><input name="frmUsername" id="frmUsername" type="text" value="<?php echo $userName; ?>" /></td>
														</tr>
														<tr> 
															<td valign="middle"><span class="loginDetail">Password :</span></td>
															<td><input name="frmPassword" type="password" id="frmPassword" value="<?php echo $userPwd; ?>" /></td>
														</tr>
														<tr align="right"> 
															<td colspan="2" align="center"><input type="submit" name="Submit" value="Login Now" /></td>
														</tr>
														<tr align="right"> 
															<td colspan="2" align="right"><br /><a href="forgotPassword.php" style="font-weight:bold">Forgot Password</a>
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