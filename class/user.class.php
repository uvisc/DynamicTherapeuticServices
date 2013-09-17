<?php
    /*********************************************************************************************/
    /************Used to get the common variable values to be used across the site****************/
    /*********************************************************************************************/

    class user 
    {
        function user()
        {
            $this->db = new db();
        }

        /**********************************************************************************************/
        /*******************Used to get the count of user with entered login details*******************/
        /**********************************************************************************************/
    
        function cntUserLogin($userName, $pwd="") 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = $userName;
            $cnt++;
            if ($pwd != "")
            {
                $filterData[$cnt] = $pwd;
                $cnt++;

                $sql = "SELECT count(UserID) AS totalUsers FROM tbl_User WHERE Status = :filter0 AND UserName = :filter1 AND Password = :filter2";
            }
            else
            {
                $sql = "SELECT count(UserID) AS totalUsers FROM tbl_User WHERE Status = :filter0 AND UserName = :filter1";
            }

            $cntUserLogin = $this->db->countRows($sql, $filterData, "1");
        
            return $cntUserLogin;
        }
        
        /*********************************************************************************************/
        /**********************Used to get the details of logged in user   ***************************/
        /*********************************************************************************************/
    
        function getUserLogin($userName, $pwd = '') 
        {
            $getUserLogin = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = "Y";
            $cnt++;
            $filterData[$cnt] = "A";
            $cnt++;
            $filterData[$cnt] = $userName;
            $cnt++;
            if ($pwd != "")
            {
                $filterData[$cnt] = $pwd;
                $cnt++;
                $sql = "SELECT A.UserID, A.FirstName, A.LastName, A.PicName, A.PicUrl, B.GroupID, B.TherapistID, B.UserGroupID, C.Group, A.Email FROM tbl_User A, tbl_UserGroup B, tbl_Group C WHERE A.Status = :filter0 AND B.DefaultView = :filter1 AND B.Status = :filter2 AND A.UserName = :filter3 AND A.Password = :filter4 AND A.UserID = B.UserID AND B.GroupID = C.GroupID";
            }
            else
            {
                $sql = "SELECT A.UserID, A.FirstName, A.LastName, A.PicName, A.PicUrl, B.GroupID, B.TherapistID, B.UserGroupID, C.Group, A.Email FROM tbl_User A, tbl_UserGroup B, tbl_Group C WHERE A.Status = :filter0 AND B.DefaultView = :filter1 AND B.Status = :filter2 AND A.UserName = :filter3 AND A.UserID = B.UserID AND B.GroupID = C.GroupID";   
            }

            $getUserLogin = $this->db->fetchSQL($sql, $filterData, "10");
            
            return $getUserLogin;
        }

        /*********************************************************************************************/
        /*********************Used to get the username of the user with passed id*********************/
        /*********************************************************************************************/
    
        function getUserName($userID) 
        {
            $getUserName = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = $userID;
            $cnt++;

            $sql = "SELECT UserName, Password FROM tbl_User WHERE Status = :filter0 AND UserID = :filter1";   
            
            $getUserName = $this->db->fetchSQL($sql, $filterData, "2");
            
            return $getUserName;
        }

        /*********************************************************************************************/
        /****************Used to get the redirect location based on the login id**********************/
        /*********************************************************************************************/

        function getRedirectFile($loginID)
        {
            $getRedirectFile = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $loginID;
            $cnt++;

            $getRedirectFile = $this->db->fetchSQL("SELECT LoginTypeURL FROM tbl_LoginType WHERE LoginTypeID = :filter0", $filterData, "1");
            
            return $getRedirectFile;
        }

        /*********************************************************************************************/
        /****************Used to get the current password for the logged in user**********************/
        /*********************************************************************************************/

        function getCurrentPassword()
        {
            $getCurrentPassword = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $_SESSION['UserID'];
            $cnt++;

            $getCurrentPassword = $this->db->fetchSQL("SELECT Password FROM tbl_User WHERE UserID = :filter0", $filterData, "1");
            
            return $getCurrentPassword;
        }

        /**********************************************************************************************/
        /*******************Used to get the count of user with entered login details*******************/
        /**********************************************************************************************/
    
        function cntUserProfile($userName, $pwd="") 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = $userName;
            $cnt++;
            if ($pwd != "")
            {
                $filterData[$cnt] = $pwd;
                $cnt++;

                $sql = "SELECT count(UserID) AS totalUsers FROM tbl_User WHERE Status = :filter0 AND UserName = :filter1 AND Password = :filter2";
            }
            else
            {
                $sql = "SELECT count(UserID) AS totalUsers FROM tbl_User WHERE Status = :filter0 AND UserName = :filter1";
            }

            $cntUserLogin = $this->db->countRows($sql, $filterData, "1");
        
            return $cntUserLogin;
        }

        /*********************************************************************************************/
        /****************Used to get the logged in user profile details.        **********************/
        /*********************************************************************************************/

        function getUserProfile()
        {
            $getUserProfile = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $_SESSION['UserID'];
            $cnt++;

            $getUserProfile = $this->db->fetchSQL("SELECT A.FirstName, A.LastName, A.Address, A.City, B.StateName, A.County, A.Zip, A.Email, A.SecondaryEmail, A.PicName, A.PicUrl, A.HomePhone, A.CellPhone FROM tbl_User A, tbl_State B WHERE A.UserID = :filter0 AND A.StateID = B.StateID", $filterData, "13");
            
            return $getUserProfile;
        }

        /*********************************************************************************************/
        /****************Used to get the current password for the logged in user**********************/
        /*********************************************************************************************/

        function updPassword($newPassword, $userID)
        {
            $updPassword = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $newPassword;
            $cnt++;
            $filterData[$cnt] = $userID;
            $cnt++;

            $updPassword = $this->db->updateSQL("UPDATE tbl_User SET Password = :filter0 WHERE UserID = :filter1", $filterData);
            
            return $updPassword;
        }
    }
?>