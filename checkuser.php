<?php
	$pageTitle = "Check User";

	include_once('include/header.php');

	$userLogin = $user->checkUserLogin();

	if (empty($userLogin))
	{
		
	}
?>
					<!--
					<div class="navbar">
						<div class="navbar-inner">
							<div class="container">
								<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Online Portal</a>
							</div>
						</div>
					</div>
				-->
<?php
	if ($maintenancePeriod[0][0] == "Y")
	{
?>					<div class="hero-unit">
						<div class="container">
							<h1>Alert/Notification</h1>
							<p class="lead">System down or any related notification.</p>
						</div>
					</div>
<?php
	}
	else
	{
?>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
	}
?>
					<div class="container">
						<div class="row-fluid navbar">
							<div class="span12" align="center">
								<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Online Portal</a>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span12" align="center">	
								<form name="frmAccountLogin" method="post" action="checkuser.php" onsubmit="return validateLoginForm()">
									<table border="1" width="30%" cellpadding="3" cellspacing="0" bordercolor="#FF9900">
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
															<span class="errorMessage" id="errMsg"></span>
														</td>
													</tr>
													<tr> 
														<td>
															<span class="loginDetail">Username :</span>
														</td>
														<td><input name="frmUsername" id="frmUsername" type="text" /></td>
													</tr>
													<tr> 
														<td valign="middle"><span class="loginDetail">Password :</span></td>
														<td><input name="frmPassword" type="password" id="frmPassword" /></td>
													</tr>
													<tr align="right"> 
														<td colspan="2" align="center"><input type="submit" name="Submit" value="Login Now" /></td>
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
<?php
	include_once('include/footer.php');
?>		