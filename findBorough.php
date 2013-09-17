<?php

    function __autoload($class_name)
    {
        include "class/" . $class_name . '.class.php';
    }

    if (isset($_POST['state']))
    {
        $return_arr = '{ "Boroughs": [';
        $value = "";
        
        $therapistClass = new therapist();
        
        $getTherapistBorough = $therapistClass->getTherapistBorough($_POST['state']);
            
        $typeArray = array_filter($getTherapistBorough);

        //echo count($getTherapistType);
        if (!empty($typeArray))
        {
            for ($i=0; $i< count($getTherapistBorough); $i++)
            {
                if ($value == "")
                {
                    $value .=  '{ "value": "' . $getTherapistBorough[$i][0] . '", "data": "' . $getTherapistBorough[$i][0] . '"}';
                }
                else
                {
                    $value .=  ', { "value": "' . $getTherapistBorough[$i][0] . '", "data": "' . $getTherapistBorough[$i][0] . '"}';
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