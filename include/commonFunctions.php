<?php

    function random_string()
    {
        $character_set_array = array();
        $character_set_array[] = array('count' => 5, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
        $character_set_array[] = array('count' => 2, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $character_set_array[] = array('count' => 1, 'characters' => '0123456789');
        $temp_array = array();
        
        foreach ($character_set_array as $character_set) {
            for ($i = 0; $i < $character_set['count']; $i++) {
                $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
            }
        }
        
        shuffle($temp_array);
        return implode('', $temp_array);
    }

    function formatPhoneDisplay($rawPhone)
    {
        if (is_numeric ($rawPhone))
        {
            $finalPhone = "(" . substr($rawPhone, 0, 3) . ") " . substr($rawPhone, 3, 3) . " - " . substr($rawPhone, 6, 4);
        }
        else
        {
            $finalPhone = "-";
        }

        return $finalPhone;
    }

    function formatRateDisplay($rawRate)
    {
        if (is_numeric ($rawRate))
        {
            $finalRate = "$" .  number_format($rawRate, 2, '.', '');
        }
        else
        {
            $finalRate = "-";
        }

        return $finalRate;
    }

    function formatDateDisplay($rawDate)
    {
        if ($rawDate != "")
        {
            $finalDate = date("jS M Y", strtotime($rawDate));
        }

        return $finalDate;
    }
?>