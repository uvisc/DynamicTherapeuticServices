<?php
	//session_start();
	$pageTitle = "Login";

	include_once('include/header.php');

	$errorMsg = "";

	if (isset($_POST['resetPwd']) && ($_POST['resetPwd'] == "Forgot Password"))
	{
		$cntUserLogin = $userClass->cntUserLogin($_POST['frmUsername'], '');
		//echo "!!!" . $cntUserLogin;

		if ($cntUserLogin > 0)
		{
			$userLogin = $userClass->getUserLogin($_POST['frmUsername'], '');

			$newArr = array_filter($userLogin);
        	if (!empty($newArr))
        	{
        		$userEmail = $userLogin[0][9];
				$tempPwd = random_string();

				require_once("phpmailer.php");

				$mail = new PHPMailer();
				$mail->IsMail();
				$mail->From = "admin@dynamiccenter.net";
				$mail->FromName = "Dynamic Therapeutic Service Support Team";
				$mail->WordWrap = 50;

				$mail->IsHTML(true);
				$mail->Subject  =  "Temporary Password";

				$emailMsg = "Hello " . $userLogin[0][1] . ", <br /><br />Your temporary password is <b>" . $tempPwd . "</b>. Please <a href='" . $siteUrl[0][0] . "/resetPassword.php?userID=" . $userLogin[0][0] . "'>click here</a> to reset your password.<br /><br />Thanks,<br />Dynamic Therapeutic Service Team";

				$mail->AddAddress($userEmail, $userLogin[0][1]);
				$mail->Body = nl2br($emailMsg);

				echo $emailMsg;

				/*
				$ok = $mail->Send(); 
				if ($ok)
				{
					$updPassword = $userClass->updPassword($_POST['frmNewPassword'], $userLogin[0][0]);
					$errorMsg = "An email has been sent with the password details. Please check your mail for further details.";
				}
				else
				{
					$errorMsg = "There was an error sending the email. Please try again later.";
				}
				*/
			}
		}
	}
?>
					<div class="row-fluid">
						<div class="container">
							<div class="row-fluid navbar">
								<div class="span12" align="center">
									<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Online Portal Forgot Password</a>
								</div>
							</div>
							<div class="row-fluid" align="center">
								<div class="span11 text-center" align="center">	
									<form name="frmForgotPwd" method="post" action="" onsubmit="return validateForgotPwdForm()">
										<table border="1" align="center" width="30%" cellpadding="3" cellspacing="0" bordercolor="#FF9900">
											<tr>
												<td align="center">
													<table width="100%" border="0" cellspacing="2" cellpadding="2">
														<tr bgcolor="#FF9900"> 
															<td colspan="2"> 
																<span class="login">Forgot Password</span>
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
															<td><input name="frmUsername" id="frmUsername" type="text" /></td>
														</tr>
														<tr align="right"> 
															<td colspan="2" align="center"><input type="submit" name="resetPwd" value="Forgot Password" /></td>
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