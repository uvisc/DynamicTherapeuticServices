<?php
    /*********************************************************************************************/
    /************Used to get the common variable values to be used across the site****************/
    /*********************************************************************************************/

    class commonVariables 
    {
        function commonVariables()
        {
            $this->db = new db();
        }

        /**********************************************************************************************/
        /*************************Used to get the display status for debugging*************************/
        /**********************************************************************************************/
    
        function getDisplayStatus() 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 'ShowDisplay';
            $cnt++;
        
            $getDisplayStatus = $this->db->fetchSQL("SELECT VariableValue FROM tbl_UserVars WHERE VariableName = :filter0", $filterData, "1");
        
            return $getDisplayStatus;
        }
        
        /*********************************************************************************************/
        /****************Used to get the selected city latitude and longitude   **********************/
        /*********************************************************************************************/
    
        function getMaintenancePeriod() 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "MaintenancePeriod";
        
            $getMaintenancePeriod = $this->db->fetchSQL("SELECT VariableValue FROM tbl_UserVars WHERE VariableName = :filter0", $filterData, "1");
        
            return $getMaintenancePeriod;
        }
        
        /*********************************************************************************************/
        /****************** Used to get the url for the site the code is being executed***************/
        /*********************************************************************************************/
    
        function getSiteUrl() 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "SiteURL";
        
            $getSiteUrl = $this->db->fetchSQL("SELECT VariableValue FROM tbl_UserVars WHERE VariableName = :filter0", $filterData, "1");
        
            return $getSiteUrl;
        }
        
        function getCityName($cityName) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $cityName;
        
            $getCityArray = $this->db->fetchSQL("SELECT CityName, StateName FROM tbl_CityList WHERE CityNameCompare LIKE :filter0 ", $filterData, "2");
        
            return $getCityArray;
        }
    }
?>