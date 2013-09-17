<?php
    /*********************************************************************************************/
    /************Used to get the common variable values to be used across the site****************/
    /*********************************************************************************************/

    class therapist 
    {
        function therapist()
        {
            $this->db = new db();
        }

        /**********************************************************************************************/
        /*******************Used to get the list of therapists with first name filter******************/
        /**********************************************************************************************/
    
        function getTherapistFName($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "%" . $queryPassed . "%";
            $cnt++;

            $getTherapistFName = $this->db->fetchSQL("SELECT DISTINCT FirstName FROM tbl_Therapists WHERE FirstName LIKE :filter0 AND deleteTherapist = 0", $filterData, "1");
        
            return $getTherapistFName;
        }
        
        /**********************************************************************************************/
        /*******************Used to get the list of therapists with last name filter*******************/
        /**********************************************************************************************/
    
        function getTherapistLName($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "%" . $queryPassed . "%";
            $cnt++;

            $getTherapistLName = $this->db->fetchSQL("SELECT DISTINCT LastName FROM tbl_Therapists WHERE LastName LIKE :filter0 AND deleteTherapist = 0", $filterData, "1");
        
            return $getTherapistLName;
        }

        /**********************************************************************************************/
        /*******************Used to get the list of therapist types based on filter *******************/
        /**********************************************************************************************/
    
        function getTherapistType($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "%" . $queryPassed . "%";
            $cnt++;

            //echo "SELECT DISTINCT TDesc FROM tbl_TherapistType WHERE TDesc LIKE :filter0";
            //echo "<br>" . $filterData[0];

            $getTherapistType = $this->db->fetchSQL("SELECT TTypeID, TDesc FROM tbl_TherapistType WHERE TDesc LIKE :filter0 ORDER BY TDesc ASC", $filterData, "2");
        
            return $getTherapistType;
        }

        /**********************************************************************************************/
        /*******************Used to get the list of therapist states based on filter*******************/
        /**********************************************************************************************/
    
        function getTherapistState($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "%" . $queryPassed . "%";
            $cnt++;

            //echo "SELECT DISTINCT TDesc FROM tbl_TherapistType WHERE TDesc LIKE :filter0";
            //echo "<br>" . $filterData[0];

            $getTherapistState = $this->db->fetchSQL("SELECT StateID, StateName, State FROM tbl_State WHERE StateName LIKE :filter0 ORDER BY StateName ASC", $filterData, "3");
        
            return $getTherapistState;
        }

        /**********************************************************************************************/
        /*******************Used to get the list of therapist boroughs based on state******************/
        /**********************************************************************************************/
    
        function getTherapistBorough($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $queryPassed;
            $cnt++;

            //echo "SELECT DISTINCT TDesc FROM tbl_TherapistType WHERE TDesc LIKE :filter0";
            //echo "<br>" . $filterData[0];

            $getTherapistBorough = $this->db->fetchSQL("SELECT Borough FROM tbl_Borough WHERE StateID = :filter0 ORDER BY Borough ASC", $filterData, "1");
        
            return $getTherapistBorough;
        }

        /**********************************************************************************************/
        /*******************Used to get the list of therapist county based on state  ******************/
        /**********************************************************************************************/
    
        function getTherapistCounty($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $queryPassed;
            $cnt++;

            //echo "SELECT DISTINCT TDesc FROM tbl_TherapistType WHERE TDesc LIKE :filter0";
            //echo "<br>" . $filterData[0];

            $getTherapistCounty = $this->db->fetchSQL("SELECT CountyName FROM tbl_EICounty WHERE StateID = :filter0 ORDER BY CountyName ASC", $filterData, "1");
        
            return $getTherapistCounty;
        }

        /**********************************************************************************************/
        /*******************Used to get the list of therapist required documents **********************/
        /**********************************************************************************************/
    
        function getTherapistReqDoc($queryPassed) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = "%" . $queryPassed . "%";
            $cnt++;

            //echo "SELECT DISTINCT TDesc FROM tbl_TherapistType WHERE TDesc LIKE :filter0";
            //echo "<br>" . $filterData[0];

            $getTherapistReqDoc = $this->db->fetchSQL("SELECT ReqDocTypeID, ReqDocName FROM tbl_RequiredDocType WHERE ReqDocName LIKE :filter0 ORDER BY ReqDocName ASC", $filterData, "2");
        
            return $getTherapistReqDoc;
        }

        /**********************************************************************************************/
        /*****************Used to get total count of therapists based on filter criteria***************/
        /**********************************************************************************************/
    
        function getTherapistIDCnt($searchGeneric, $searchStatus, $searchZip, $searchTherapistType, $searchState, $searchBorough, $searchCounty, $searchReqDoc) 
        {
            $filterData = array();
            $tables = "tbl_Therapists A, tbl_State B";
            $columnCnt = 0;
            $whereClause = " WHERE A.StateID = B.StateID AND A.deleteTherapist = 0";
            $cnt = 0;

            if ($searchGeneric != "")
            {
                $whereClause .= " AND (A.LastName LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchGeneric . "%";
                $cnt++;

                $whereClause .= " OR A.FirstName LIKE :filter" . $cnt . ")"; 
                $filterData[$cnt] = "%" . $searchGeneric . "%";
                $cnt++;
            }

            if ($searchStatus != "")
            {
                switch ($searchStatus)
                {
                    case 1:
                        $whereClause .= " AND A.Active = :filter" . $cnt;
                        $filterData[$cnt] = "1";
                        $cnt++;
                    break;
                    case 2:
                        $whereClause .= " AND A.Active = :filter" . $cnt;
                        $filterData[$cnt] = "0";
                        $cnt++;
                    break;
                    case 3:
                        $whereClause .= " AND A.autoAccept = :filter" . $cnt;
                        $filterData[$cnt] = "1";
                        $cnt++;
                    break;
                    case 4:
                        $whereClause .= " AND A.autoAccept = :filter" . $cnt;
                        $filterData[$cnt] = "0";
                        $cnt++;
                    break;
                    default:    
                    break;
                }
            }

            if ($searchZip != "")
            {
                $whereClause .= " AND A.Zip LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchZip . "%";
                $cnt++;
            }

            if ($searchTherapistType != "")
            {
                $tables .= ", tbl_TherapistType C";
                $whereClause .= " AND A.TTypeID = C.TTypeID AND A.TTypeID = :filter" . $cnt; 
                $filterData[$cnt] = $searchTherapistType;
                $cnt++;
            }

            if ($searchState != "")
            {
                $whereClause .= " AND A.StateID = :filter" . $cnt; 
                $filterData[$cnt] = $searchState;
                $cnt++;
            }

            if ($searchBorough != "")
            {
                $whereClause .= " AND A.Borough LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchBorough . "%";
                $cnt++;
            }

            if ($searchCounty != "")
            {
                $whereClause .= " AND A.County LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchCounty . "%";
                $cnt++;
            }

            if ($searchReqDoc != "")
            {
                $tables .= ", tbl_TherapistRequiredDocs D, tbl_RequiredDocType E";
                $whereClause .= " AND D.ReqDocTypeID = E.ReqDocTypeID AND A.TherapistID = D.TherapistID AND D.ReqDocTypeID = :filter" . $cnt . " AND D.ReqDocExists = 1"; 
                $filterData[$cnt] = $searchReqDoc;
                $cnt++;
            }

            //echo "SELECT count(DISTINCT A.TherapistID) as totalCnt FROM " . $tables . $whereClause;

            $getTherapistIDCnt = $this->db->countRows("SELECT count(DISTINCT A.TherapistID) as totalCnt FROM " . $tables . $whereClause, $filterData, "1");
        
            return $getTherapistIDCnt;
        }

        /**********************************************************************************************/
        /******************Used to get the list of therapists based on filter criteria*****************/
        /**********************************************************************************************/
    
        function getTherapistID($searchGeneric, $searchStatus, $searchZip, $searchTherapistType, $searchState, $searchBorough, $searchCounty, $searchReqDoc, $searchPage) 
        {
            $filterData = array();
            $tables = "tbl_Therapists A, tbl_State B";
            $columnCnt = 0;
            $whereClause = " WHERE A.StateID = B.StateID AND A.deleteTherapist = 0";
            $cnt = 0;
            $offset = "";

            if ($searchGeneric != "")
            {
                $whereClause .= " AND (A.LastName LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchGeneric . "%";
                $cnt++;

                $whereClause .= " OR A.FirstName LIKE :filter" . $cnt . ")"; 
                $filterData[$cnt] = "%" . $searchGeneric . "%";
                $cnt++;
            }

            if ($searchStatus != "")
            {
                switch ($searchStatus)
                {
                    case 1:
                        $whereClause .= " AND A.Active = :filter" . $cnt;
                        $filterData[$cnt] = "1";
                        $cnt++;
                    break;
                    case 2:
                        $whereClause .= " AND A.Active = :filter" . $cnt;
                        $filterData[$cnt] = "0";
                        $cnt++;
                    break;
                    case 3:
                        $whereClause .= " AND A.autoAccept = :filter" . $cnt;
                        $filterData[$cnt] = "1";
                        $cnt++;
                    break;
                    case 4:
                        $whereClause .= " AND A.autoAccept = :filter" . $cnt;
                        $filterData[$cnt] = "0";
                        $cnt++;
                    break;
                    default:    
                    break;
                }
            }

            if ($searchZip != "")
            {
                $whereClause .= " AND A.Zip LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchZip . "%";
                $cnt++;
            }

            if ($searchTherapistType != "")
            {
                $tables .= ", tbl_TherapistType C";
                $whereClause .= " AND A.TTypeID = C.TTypeID AND A.TTypeID = :filter" . $cnt; 
                $filterData[$cnt] = $searchTherapistType;
                $cnt++;
            }

            if ($searchState != "")
            {
                $whereClause .= " AND A.StateID = :filter" . $cnt; 
                $filterData[$cnt] = $searchState;
                $cnt++;
            }

            if ($searchBorough != "")
            {
                $whereClause .= " AND A.Borough LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchBorough . "%";
                $cnt++;
            }

            if ($searchCounty != "")
            {
                $whereClause .= " AND A.County LIKE :filter" . $cnt; 
                $filterData[$cnt] = "%" . $searchCounty . "%";
                $cnt++;
            }

            if ($searchReqDoc != "")
            {
                $tables .= ", tbl_TherapistRequiredDocs D, tbl_RequiredDocType E";
                $whereClause .= " AND D.ReqDocTypeID = E.ReqDocTypeID AND A.TherapistID = D.TherapistID AND D.ReqDocTypeID = :filter" . $cnt . " AND D.ReqDocExists = 1"; 
                $filterData[$cnt] = $searchReqDoc;
                $cnt++;
            }

            if ($searchPage != "")
            {
                $startRec = ($searchPage - 1) * 20;
                $offset = " LIMIT " . $startRec . ", 20";
            }

            //echo "SELECT DISTINCT A.TherapistID FROM " . $tables . $whereClause . " ORDER BY A.LastName ASC ";

            $getTherapistID = $this->db->fetchSQL("SELECT DISTINCT A.TherapistID FROM " . $tables . $whereClause . " ORDER BY A.LastName ASC " . $offset, $filterData, "1");
        
            return $getTherapistID;
        }

        /**********************************************************************************************/
        /******************Used to get the selected therapist details                 *****************/
        /**********************************************************************************************/
    
        function getTherapistDetails($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;

            $getTherapistDetails = $this->db->fetchSQL("SELECT TherapistID, LastName, FirstName, SSN, Address, City, Zip, ZipExtn, Borough, County, HomePhone, CellPhone, CellType, BusPhone, FaxNo, Email, SecondaryEmail, PicName, PicUrl, DocFileUrl, DocFileName, TType, Rate, EIRate, TaxStatus, WorkAvailability, AvailableSummer, AvailableSchoolYear, AvailableEI, TravelZone, TravelZoneZips, Notes, Active, A.DateEntered AS dateEntered, A.UserID AS adderID, A.DateUpdated AS dateUpdated, A.UpdaterUserID AS updaterID, autoAccept, SkypeID, DOB, State, TherapistProviderName, AgencyName, CellAddress FROM tbl_Therapists A LEFT JOIN tbl_State B ON A.StateID = B.StateID LEFT JOIN tbl_TherapistProvider C ON C.TherapistProviderID = A.TherapistProviderID LEFT JOIN tbl_Agency D ON A.AgencyID = D.AgencyID LEFT JOIN tbl_CellType E ON A.CellTypeID = E.CellTypeID LEFT JOIN tbl_TherapistType F ON A.TTypeID = F.TTypeID WHERE  A.TherapistID = :filter0 ORDER BY A.LastName ASC", $filterData, "44");
        
            return $getTherapistDetails;
        }

        /**********************************************************************************************/
        /******************Used to get the referenced by details for the therapist    *****************/
        /**********************************************************************************************/
    
        function getReferenceName($therapistProviderID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistProviderID;
            $cnt++;
            
            $getReferenceName = $this->db->fetchSQL("SELECT TherapistProviderName FROM tbl_TherapistProvider WHERE TherapistProviderID = :filter0", $filterData, "1");
        
            return $getReferenceName;
        }

        /**********************************************************************************************/
        /******************Used to get the referenced by details for the therapist    *****************/
        /**********************************************************************************************/
    
        function getAgencyName($therapistAgencyID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistAgencyID;
            $cnt++;
            
            $getAgencyName = $this->db->fetchSQL("SELECT AgencyName FROM tbl_Agency WHERE AgencyID = :filter0", $filterData, "1");
        
            return $getAgencyName;
        }

        /**********************************************************************************************/
        /******************Used to get count of servicing state details for therapist *****************/
        /**********************************************************************************************/
    
        function cntServicingState($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $cntServicingState = $this->db->countRows("SELECT COUNT(State) as totalCnt FROM tbl_TherapistServicingState A LEFT JOIN tbl_State B ON A.StateID = B.StateID WHERE A.TherapistID = :filter0 AND A.StateID != 0", $filterData, "1");
        
            return $cntServicingState;
        }

        /**********************************************************************************************/
        /******************Used to get the servicing state details for the therapist  *****************/
        /**********************************************************************************************/
    
        function getServicingState($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $getServicingState = $this->db->fetchSQL("SELECT State FROM tbl_TherapistServicingState A LEFT JOIN tbl_State B ON A.StateID = B.StateID WHERE A.TherapistID = :filter0 AND A.StateID != 0", $filterData, "1");
        
            return $getServicingState;
        }

        /**********************************************************************************************/
        /******************Used to get count of covansys approval for the therapist  ******************/
        /**********************************************************************************************/
    
        function cntCovansysApproval($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            $filterData[$cnt] = 11;
            $cnt++;
            $filterData[$cnt] = 1;
            $cnt++;
            
            $cntCovansysApproval = $this->db->countRows("SELECT COUNT(A.ReqDocTypeID) as totalCnt FROM tbl_TherapistRequiredDocs A, tbl_RequiredDocType B WHERE A.ReqDocTypeID = B.ReqDocTypeID AND A.TherapistID = :filter0 AND A.ReqDocTypeID = :filter1 AND A.ReqDocExists = :filter2", $filterData, "1");
        
            return $cntCovansysApproval;
        }

        /**********************************************************************************************/
        /******************Used to get count of trainings attended by the therapist *******************/
        /**********************************************************************************************/
    
        function cntTrainingsAttended($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $cntTrainingsAttended = $this->db->countRows("SELECT COUNT(TherapistTrainingID) as totalCnt FROM tbl_TherapistTraining WHERE TherapistID = :filter0", $filterData, "1");
        
            return $cntTrainingsAttended;
        }

        /**********************************************************************************************/
        /******************Used to get the trainings attended by the therapist  ***********************/
        /**********************************************************************************************/
    
        function getTrainingsAttended($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $getTrainingsAttended = $this->db->fetchSQL("SELECT TrainingName, TrainingDate FROM tbl_TherapistTraining WHERE TherapistID = :filter0", $filterData, "2");
        
            return $getTrainingsAttended;
        }

        /**********************************************************************************************/
        /******************Used to get count of therapist availability              *******************/
        /**********************************************************************************************/
    
        function cntTherapistAvailability($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $cntTherapistAvailability = $this->db->countRows("SELECT COUNT(TherapistWorkAvailabilityID) as totalCnt FROM as_TherapistWorkAvailability WHERE TherapistID = :filter0", $filterData, "1");
        
            return $cntTherapistAvailability;
        }

        /**********************************************************************************************/
        /******************Used to get the therapist availability details       ***********************/
        /**********************************************************************************************/
    
        function getTherapistAvailability($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $getTherapistAvailability = $this->db->fetchSQL("SELECT AvailableSummer, SummerTimePeriodID, AvailableSchoolYear, SchoolYearTimePeriodID, AvailableEI, EITimePeriodID FROM as_TherapistWorkAvailability WHERE TherapistID = :filter0", $filterData, "6");
        
            return $getTherapistAvailability;
        }

        /**********************************************************************************************/
        /******************Used to get count of time period for therapist           *******************/
        /**********************************************************************************************/
    
        function cntTimePeriod($timePeriodID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $timePeriodID;
            $cnt++;
            $filterData[$cnt] = "Y";
            $cnt++;
            
            $cntTimePeriod = $this->db->countRows("SELECT COUNT(TimePeriodID) as totalCnt FROM tbl_TimePeriod WHERE TimePeriodID = :filter0 AND Visible = :filter1", $filterData, "1");
        
            return $cntTimePeriod;
        }

        /**********************************************************************************************/
        /******************Used to get the time period value for the therapist  ***********************/
        /**********************************************************************************************/
    
        function getTimePeriod($timePeriodID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $timePeriodID;
            $cnt++;
            $filterData[$cnt] = "Y";
            $cnt++;
            
            $getTimePeriod = $this->db->fetchSQL("SELECT TimePeriod FROM tbl_TimePeriod WHERE TimePeriodID = :filter0 AND Visible = :filter1", $filterData, "1");
        
            return $getTimePeriod;
        }

        /**********************************************************************************************/
        /******************Used to mark the therapist as delete.                ***********************/
        /**********************************************************************************************/
    
        function deleteTherapist($therapistID) 
        {
            $deleteTherapist = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = $therapistID;
            $cnt++;

            echo "UPDATE tbl_Therapists SET deleteTherapist = :filter0 WHERE TherapistID = :filter1";

            $deleteTherapist = $this->db->updateSQL("UPDATE tbl_Therapists SET deleteTherapist = :filter0 WHERE TherapistID = :filter1", $filterData);
            
            return $deleteTherapist;
        }

        /**********************************************************************************************/
        /******************Used to get count of notes for therapist                 *******************/
        /**********************************************************************************************/
    
        function getTherapistNotesCnt($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $getTherapistNotesCnt = $this->db->countRows("SELECT COUNT(NoteID) as totalCnt FROM tbl_TherapistNotes WHERE TherapistID = :filter0 ORDER BY NoteID DESC", $filterData, "1");
        
            return $getTherapistNotesCnt;
        }

        /**********************************************************************************************/
        /******************Used to get the time period value for the therapist  ***********************/
        /**********************************************************************************************/
    
        function getTherapistNotes($therapistID) 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $therapistID;
            $cnt++;
            
            $getTherapistNotes = $this->db->fetchSQL("SELECT A.Notes, A.DateEntered, concat(B.FirstName, ' ', B.LastName) AS enteredBy, C.Year FROM tbl_TherapistNotes A LEFT JOIN tbl_User B ON A.UserID = B.UserID LEFT JOIN tbl_year C ON A.YearID = C.YearID WHERE A.TherapistID = :filter0", $filterData, "4");
        
            return $getTherapistNotes;
        }

    }
?>