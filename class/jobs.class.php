<?php
    /*********************************************************************************************/
    /************Used to get the common variable values to be used across the site****************/
    /*********************************************************************************************/

    class jobs 
    {
        function jobs()
        {
            $this->db = new db();
        }

        /**********************************************************************************************/
        /*****************Used to get the count of active of active jobs for therapist*****************/
        /**********************************************************************************************/
    
        function cntActiveJobs($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            $filterData[$cnt] = 0;
            $cnt++;

            $cntActiveJobs = $this->db->countRows("SELECT count(DISTINCT JobID) as totalCnt FROM tbl_JobGrid WHERE TherapistID = :filter0 AND JobStatus = :filter1", $filterData, "1");
        
            return $cntActiveJobs;
        }
    }
?>