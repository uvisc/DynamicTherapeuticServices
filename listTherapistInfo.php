<?php
	$pageTitle = "Therapist List";
	$targetpage = "listTherapistInfo.php";

	$errorMsg = "";

	include_once('include/header.php');

	$searchGeneric = "";
	$searchStatus = "";
	$searchZip = "";
	$searchTherapistType = "";
	$searchState = "";
	$searchBorough = "";
	$searchCounty = "";
	$searchReqDoc = "";
	$searchPage = "1";
	$moreVar = "";

	if (isset($_POST['searchGeneric']) && ($_POST['searchGeneric'] != ""))
	{
		$searchGeneric = $_POST['searchGeneric'];
		$moreVar .= "&searchGeneric=" . $_POST['searchGeneric'];
	}
	else
	{
		if (isset($_GET['searchGeneric']) && ($_GET['searchGeneric'] != ""))
		{
			$searchGeneric = $_GET['searchGeneric'];
			$moreVar .= "&searchGeneric=" . $_GET['searchGeneric'];
		}
		else
		{
			$searchGeneric = "";
		}
	}

	if (isset($_POST['searchStatus']) && ($_POST['searchStatus'] != ""))
	{
		$searchStatus = $_POST['searchStatus'];
		$moreVar .= "&searchStatus=" . $_POST['searchStatus'];
	}
	else
	{
		if (isset($_GET['searchStatus']) && ($_GET['searchStatus'] != ""))
		{
			$searchStatus = $_GET['searchStatus'];
			$moreVar .= "&searchStatus=" . $_GET['searchStatus'];
		}
		else
		{
			$searchStatus = "";
		}
	}

	if (isset($_POST['searchZip']) && ($_POST['searchZip'] != ""))
	{
		$searchZip = $_POST['searchZip'];
		$moreVar .= "&searchZip=" . $_POST['searchZip'];
	}
	else
	{
		if (isset($_GET['searchZip']) && ($_GET['searchZip'] != ""))
		{
			$searchZip = $_GET['searchZip'];
			$moreVar .= "&searchZip=" . $_GET['searchZip'];
		}
		else
		{
			$searchZip = "";
		}
	}

	if (isset($_POST['searchTherapistType']) && ($_POST['searchTherapistType'] != ""))
	{
		$searchTherapistType = $_POST['searchTherapistType'];
		$moreVar .= "&searchTherapistType=" . $_POST['searchTherapistType'];
	}
	else
	{
		if (isset($_GET['searchTherapistType']) && ($_GET['searchTherapistType'] != ""))
		{
			$searchTherapistType = $_GET['searchTherapistType'];
			$moreVar .= "&searchTherapistType=" . $_GET['searchTherapistType'];
		}
		else
		{
			$searchTherapistType = "";
		}
	}

	if (isset($_POST['searchState']) && ($_POST['searchState'] != ""))
	{
		$searchState = $_POST['searchState'];
		$moreVar .= "&searchState=" . $_POST['searchState'];
	}
	else
	{
		if (isset($_GET['searchState']) && ($_GET['searchState'] != ""))
		{
			$searchState = $_GET['searchState'];
			$moreVar .= "&searchState=" . $_GET['searchState'];
		}
		else
		{
			$searchState = "";
		}
	}

	if (isset($_POST['searchBorough']) && ($_POST['searchBorough'] != ""))
	{
		$searchBorough = $_POST['searchBorough'];
		$moreVar .= "&searchBorough=" . $_POST['searchBorough'];
	}
	else
	{
		if (isset($_GET['searchBorough']) && ($_GET['searchBorough'] != ""))
		{
			$searchBorough = $_GET['searchBorough'];
			$moreVar .= "&searchBorough=" . $_GET['searchBorough'];
		}
		else
		{
			$searchBorough = "";
		}
	}

	if (isset($_POST['searchCounty']) && ($_POST['searchCounty'] != ""))
	{
		$searchCounty = $_POST['searchCounty'];
		$moreVar .= "&searchCounty=" . $_POST['searchCounty'];
	}
	else
	{
		if (isset($_GET['searchCounty']) && ($_GET['searchCounty'] != ""))
		{
			$searchCounty = $_GET['searchCounty'];
			$moreVar .= "&searchCounty=" . $_GET['searchCounty'];
		}
		else
		{
			$searchCounty = "";
		}
	}

	if (isset($_POST['searchReqDoc']) && ($_POST['searchReqDoc'] != ""))
	{
		$searchReqDoc = $_POST['searchReqDoc'];
		$moreVar .= "&searchReqDoc=" . $_POST['searchReqDoc'];
	}
	else
	{
		if (isset($_GET['searchReqDoc']) && ($_GET['searchReqDoc'] != ""))
		{
			$searchReqDoc = $_GET['searchReqDoc'];
			$moreVar .= "&searchReqDoc=" . $_GET['searchReqDoc'];
		}
		else
		{
			$searchReqDoc = "";
		}
	}

	if (isset($_GET['page']) && ($_GET['page'] != "1"))
	{
		$searchPage = $_GET['page'];
		$page = $searchPage;
	}
	else
	{
		$searchPage = "1";
		$page = $searchPage;
	}

	$getTherapistIDCnt = $therapistClass->getTherapistIDCnt($searchGeneric, $searchStatus, $searchZip, $searchTherapistType, $searchState, $searchBorough, $searchCounty, $searchReqDoc);
	$total_pages = $getTherapistIDCnt;

	$getTherapistID = $therapistClass->getTherapistID($searchGeneric, $searchStatus, $searchZip, $searchTherapistType, $searchState, $searchBorough, $searchCounty, $searchReqDoc, $searchPage);

	$startRec= (($searchPage - 1) * 20) + 1;
	$endRec = $startRec + 19;

	if ($endRec  > $total_pages)
	{
		$endRec = $total_pages;
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
										<a href="#" class="brand">View Therapist List</a>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center" id="loading">	
										<img id="loading-image" src="images/loading.gif" height="50px" width="50px" alt="Loading..." />
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<?php include("therapistSearch.php"); ?>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										&nbsp;
									</div>
								</div>
								<div class="row-fluid">
									<div class="span7" align="center">	
										<!--<?php include("paginationLink.php"); ?>-->
										<div id="paginationLink"></div>
										<input type="hidden" name="fileName" id="fileName" value="<?php echo $targetpage; ?>" />
										<input type="hidden" name="moreVars" id="moreVars" value="<?php echo $moreVar; ?>" />
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<div class="row-fluid">
											<div class="span12 text-right">
												<span>
													Total records found: <?php echo $getTherapistIDCnt; ?>
													<br />
													<span id="showingRec"></span>
													Showing <?php echo $startRec . " - " . $endRec; ?>
												</span>
											</div>
										</div>
								    </div>    
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<?php include("includeTherapistList.php"); ?>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										&nbsp;
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<?php include("paginationLink.php"); ?>
									</div>
								</div>
							</div>
						</div>
<?php
	include_once('include/footer.php');
?>		