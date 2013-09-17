function validateLoginForm() {
	if ($('#frmUsername').val() == "")
	{
		$('#errMsg').text('Please enter your username');
		$('#frmUsername').focus();
		$('#frmUsername').addClass("errorText");
		return false;
	}

	$('#frmUsername').removeClass("errorText");

	if ($('#frmPassword').val() == "")
	{
		$('#errMsg').text('Please enter your password');
		$('#frmPassword').focus();
		$('#frmPassword').addClass("errorText");
		return false;
	}

	$('#frmPassword').removeClass("errorText");

	return true;
}

function validateForgotPwdForm() {
	if ($('#frmUsername').val() == "")
	{
		$('#errMsg').text('Please enter your username');
		$('#frmUsername').focus();
		$('#frmUsername').addClass("errorText");
		return false;
	}

	$('#frmUsername').removeClass("errorText");

	return true;
}

function validateResetPwdForm() {
	if ($('#currentPassword').val() == "") 
	{
		$('#errMsg').text('Please enter your temporary password.');
		$('#currentPassword').focus();
		$('#currentPassword').addClass("errorText");
		return false;
	}

	$('#currentPassword').removeClass("errorText");

	if ($('#newPassword').val() == "") 
	{
		$('#errMsg').text('Please enter your new password.');
		$('#newPassword').focus();
		$('#newPassword').addClass("errorText");
		return false;
	}

	$('#newPassword').removeClass("errorText");

	if ($('#newPassword1').val() == "") 
	{
		$('#errMsg').text('Please re-enter your new password.');
		$('#newPassword1').focus();
		$('#newPassword1').addClass("errorText");
		return false;
	}

	$('#newPassword1').removeClass("errorText");

	if ($('#newPassword1').val() != $('#newPassword').val()) 
	{
		$('#errMsg').html('The passwords entered do not match.<br />Please re-enter your new password.');
		$('#newPassword1').focus();
		$('#newPassword1').addClass("errorText");
		return false;
	}

	$('#newPassword1').removeClass("errorText");

	if ($('#currentPassword').val() != $('#tmpPassword').val()) 
	{
		$('#errMsg').html('The temporary password entered do not match with the records.<br />Please re-enter your temporary password.');
		$('#currentPassword').focus();
		$('#currentPassword').addClass("errorText");
		return false;
	}

	$('#currentPassword').removeClass("errorText");


	return true;
}

function validatePwdForm() {
	if ($('#frmCurrentPassword').val() == "")
	{
		$('#errMsg').text('Please enter your current password');
		$('#frmCurrentPassword').focus();
		$('#frmCurrentPassword').addClass("errorText");
		return false;
	}

	$('#frmCurrentPassword').removeClass("errorText");

	if ($('#frmNewPassword').val() == "")
	{
		$('#errMsg').text('Please enter your new password');
		$('#frmNewPassword').focus();
		$('#frmNewPassword').addClass("errorText");
		return false;
	}

	$('#frmNewPassword').removeClass("errorText");

	if ($('#frmNewPassword1').val() == "")
	{
		$('#errMsg').text('Please re-enter your new password');
		$('#frmNewPassword1').focus();
		$('#frmNewPassword1').addClass("errorText");
		return false;
	}

	$('#frmNewPassword1').removeClass("errorText");

	if ($('#frmNewPassword').val() != $('#frmNewPassword1').val())
	{
		$('#errMsg').text('The new passwords do not match. Please enter your new password');
		$('#frmNewPassword1').focus();
		$('#frmNewPassword1').addClass("errorText");
		return false;
	}

	$('#frmNewPassword1').removeClass("errorText");
	
	return true;
}