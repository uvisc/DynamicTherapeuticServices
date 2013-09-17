<?php

    function __autoload($class_name)
    {
        include "class/" . $class_name . '.class.php';
    }

    if (isset($_GET['query']))
    {
        $return_arr = '{ "suggestions": [';
        $value = "";
        
        $therapistClass = new therapist();
        
        $getTherapistFirstName = $therapistClass->getTherapistFName($_GET['query']);
            
        for ($i=0; $i< count($getTherapistFirstName); $i++)
        {
            if ($value == "")
            {
                $value .=  '{ "value": "' . $getTherapistFirstName[$i][0] . '", "data": "' . $getTherapistFirstName[$i][0] . '"}';
            }
            else
            {
                //$return_arr[] =  $merchantList[$i][0];
                $value .=  ', { "value": "' . $getTherapistFirstName[$i][0] . '", "data": "' . $getTherapistFirstName[$i][0] . '"}';
            }   
        }
        
        $getTherapistLastName = $therapistClass->getTherapistLName($_GET['query']);

        for ($i=0; $i< count($getTherapistLastName); $i++)
        {
            if ($value == "")
            {
                $value .=  '{ "value": "' . $getTherapistLastName[$i][0] . '", "data": "' . $getTherapistLastName[$i][0] . '"}';
            }   
            else
            {
                $value .=  ', { "value": "' . $getTherapistLastName[$i][0] . '", "data": "' . $getTherapistLastName[$i][0] . '"}';
            }
        }
        
        $return_arr .= $value;
        $return_arr .= "]}";
        header('Content-Type: application/json');
        
        echo $return_arr;
        
        /* Toss back results as json encoded array. */
        //echo json_encode($return_arr);
    }

?>