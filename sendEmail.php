<?php
	require_once("phpmailer.php");

	$mail = new PHPMailer();
	$mail->IsMail();

	$mail->WordWrap = 50;
				
	$mail->IsHTML(true);
	$mail->Subject  =  $_POST['subject'];
				
	$emailMsg = $_POST['msgDesc'];

	if ($_POST['emailType'] == "A")
	{
		$mail->From = $_POST['email'];
		$mail->FromName = $_POST['name'];
	
		$mail->AddAddress("admin@dynamiccenter.net", "Admin Dynamic Therapeutic Services");
		$mail->AddBCC("info@dynamiccenter.net", "Admin Dynamic Therapeutic Services");
	}

	if ($_POST['emailType'] == "T")
	{
		$mail->From = 'admin@dynamiccenter.net';
		$mail->FromName = 'Admin Dynamic Therapeutic Services';
	
		$mail->AddAddress($_POST['name'], $_POST['email']);
		$mail->AddBCC("info@dynamiccenter.net", "Admin Dynamic Therapeutic Services");
	}

	$mail->Body = nl2br($emailMsg);

	/*
	$ok = $mail->Send(); 
				
	if ($ok)
	{
		$sentEmail = "1";
	}
	else
	{
		$sentEmail = "0";
	}
	*/

	$sentEmail = "1";

	header("content-type: application/json");
	echo $sentEmail;
?>