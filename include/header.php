<?php
	session_start();
	
	require_once("commonFunctions.php");

	function __autoload($class_name)
    {
        include "class/" . $class_name . '.class.php';
    }

    $commonVariables = new commonVariables();
    $userClass = new user();
    $menuClass = new menu();
    $therapistClass = new therapist();
    $jobsClass = new jobs();

	$displayValue = $commonVariables->getDisplayStatus();
	$maintenancePeriod = $commonVariables->getMaintenancePeriod();
	$siteUrl = $commonVariables->getSiteUrl();
?>

<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-width=1.0">
		<title>Dynamic Therapeutic Services - <?php echo $pageTitle; ?></title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.css">
		<link rel="stylesheet" href="css/customstyle.css">
		<link rel="stylesheet" href="css/customFonts.css">
		<link rel="stylesheet" href="css/easy-responsive-tabs.css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<link rel="stylesheet/less" type="text/css" href="css/styles.less" />
	</head>
	<body>
		<!--<div class="container" style="border: 1px solid #FF0000">-->
			<div class="row-fluid" style="border: 1px solid #000">
				<div class="span1">
         			<img src="images/logo.jpg" width="81" height="410" />
           		</div>
				<div class="span11">
					<div class="row-fluid">
						<br />
<?php
	if (isset($_SESSION['UserID']))
	{
		if ($pageTitle != "Login")
		{
			include_once("adminMenu.php");
		}
	}
	else
	{
		if ($pageTitle != "Login")
		{
			header("Location:index.php");
		}
	}
?>
         			</div>
         			<hr>
         				
