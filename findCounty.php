<?php

    function __autoload($class_name)
    {
        include "class/" . $class_name . '.class.php';
    }

    if (isset($_POST['state']))
    {
        $return_arr = '{ "County": [';
        $value = "";
        
        $therapistClass = new therapist();
        
        $getTherapistCounty = $therapistClass->getTherapistCounty($_POST['state']);
            
        $typeArray = array_filter($getTherapistCounty);

        //echo count($getTherapistType);
        if (!empty($typeArray))
        {
            for ($i=0; $i< count($getTherapistCounty); $i++)
            {
                if ($value == "")
                {
                    $value .=  '{ "value": "' . $getTherapistCounty[$i][0] . '", "data": "' . $getTherapistCounty[$i][0] . '"}';
                }
                else
                {
                    $value .=  ', { "value": "' . $getTherapistCounty[$i][0] . '", "data": "' . $getTherapistCounty[$i][0] . '"}';
                }   
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