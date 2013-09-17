<?php
	function __autoload($class_name)
    {
        include "class/" . $class_name . '.class.php';
    }

    if (isset($_POST['therapistID']))
    {
        $therapistClass = new therapist();

        $updTherapist = $therapistClass->deleteTherapist($_POST['therapistID']);

        $redirectFile = "Location: listTherapistInfo.php";

        if ($_POST['parameterPassed'] != "")
        {
        	$redirectFile .= "?" . $_POST['parameterPassed'];        	
        }
		
		header($redirectFile);
    }
?>