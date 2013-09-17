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
        
        $getTherapistType = $therapistClass->getTherapistType($_GET['query']);
            
        $typeArray = array_filter($getTherapistType);

        //echo count($getTherapistType);
        if (!empty($typeArray))
        {
            for ($i=0; $i< count($getTherapistType); $i++)
            {
                if ($value == "")
                {
                    $value .=  '{ "value": "' . $getTherapistType[$i][0] . '", "data": "' . $getTherapistType[$i][0] . '"}';
                }
                else
                {
                    $value .=  ', { "value": "' . $getTherapistType[$i][0] . '", "data": "' . $getTherapistType[$i][0] . '"}';
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