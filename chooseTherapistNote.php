<?php
	$pageTitle = "Therapist Notes";
	
	$errorMsg = "";

	include_once('include/header.php');

	$therapistID = $_GET['TherapistID'];

	$getTherapistNotesCnt = $therapistClass->getTherapistNotesCnt($therapistID);
	$total_pages = $getTherapistNotesCnt;

	$getTherapistNotes = $therapistClass->getTherapistNotes($therapistID);

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
										<a href="#" class="brand">View Therapist Notes</a>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center" id="loading">	
										<img id="loading-image" src="images/loading.gif" height="50px" width="50px" alt="Loading..." />
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<div class="row-fluid">
											<div class="span12 text-right">
												<span>
													Total notes found: <?php echo $getTherapistNotesCnt; ?>
												</span>
											</div>
										</div>
								    </div>    
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										&nbsp;
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<div class="row-fluid detailHeader">
											<div class="span4" align="left">Notes</div>
											<div class="span2" align="left">Year</div>
											<div class="span3" align="left">Entered By</div>
											<div class="span3" align="left">Date Entered</div>
										</div>
<?php
	if ($getTherapistNotesCnt > 0)
	{
		for ($cntTherapistNotes = 0; $cntTherapistNotes < $getTherapistNotesCnt; $cntTherapistNotes++)
		{
?>
										<div class="row-fluid">
											<div class="span4" align="left"><?php echo $getTherapistNotes[$cntTherapistNotes][0]; ?></div>
											<div class="span2" align="left"><?php echo $getTherapistNotes[$cntTherapistNotes][3]; ?></div>
											<div class="span3" align="left"><?php echo $getTherapistNotes[$cntTherapistNotes][2]; ?></div>
											<div class="span3" align="left"><?php echo formatDateDisplay($getTherapistNotes[$cntTherapistNotes][1]); ?></div>
										</div>
										<hr>
<?php
		}
	}
	else
	{
?>
										<div class="row-fluid ">
											<div class="span12" align="center">No notes found.</div>
										</div>				
<?php		
	}
?>										
									</div>
								</div>
							</div>
						</div>
<?php
	include_once('include/footer.php');
?>		