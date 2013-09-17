<?php
    /*********************************************************************************************/
    /************Used to get the common variable values to be used across the site****************/
    /*********************************************************************************************/

    class menu 
    {
        function menu()
        {
            $this->db = new db();
        }

        /**********************************************************************************************/
        /*******************Used to get the count of user with entered login details*******************/
        /**********************************************************************************************/
    
        function cntMenuCategory() 
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $_SESSION['GroupID'];
            $cnt++;
            $filterData[$cnt] = "A";
            $cnt++;
            
            $cntMenuCategory = $this->db->countRows("SELECT count(A.MnCatGrpID) AS totalMenuCategories FROM as_MenuCategoryGroup A, tbl_MenuCategory B WHERE A.MenuCategoryID = B.MenuCategoryID AND A.GroupID = :filter0 AND A.MenuCategoryGroupStatus = :filter1", $filterData, "1");
        
            return $cntMenuCategory;
        }
        
        /*********************************************************************************************/
        /**********************Used to get the details of logged in user   ***************************/
        /*********************************************************************************************/
    
        function menuCategories() 
        {
            $getMenuCategories = "";
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $_SESSION['GroupID'];
            $cnt++;
            $filterData[$cnt] = "A";
            $cnt++;

            $getMenuCategories = $this->db->fetchSQL("SELECT A.MenuCategoryID, B.MenuCategory FROM as_MenuCategoryGroup A, tbl_MenuCategory B WHERE A.MenuCategoryID = B.MenuCategoryID AND A.GroupID = :filter0 AND A.MenuCategoryGroupStatus = :filter1 ORDER BY B.Sort ASC", $filterData, "2");
            
            return $getMenuCategories;
        }

        /*********************************************************************************************/
        /***************Used to get the count of favorite menus for logged in user********************/
        /*********************************************************************************************/

        function cntFavMenu()
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $_SESSION['UserID'];
            $cnt++;
            $filterData[$cnt] = $_SESSION['UserGroupID'];
            $cnt++;
            $filterData[$cnt] = 1;
            $cnt++;

            $cntFavMenu = $this->db->countRows("SELECT count(A.MenuID) AS totalFavMenu FROM tbl_Menu A, tbl_FavMenu B WHERE A.MenuID = B.MenuID AND B.UserID = :filter0 AND B.UserGroupID = :filter1 AND A.Active = :filter2", $filterData, "1");
            
            return $cntFavMenu;
        }

        /*********************************************************************************************/
        /****************Used to get the favorite menus for logged in user      **********************/
        /*********************************************************************************************/

        function getFavMenu()
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = $_SESSION['UserID'];
            $cnt++;
            $filterData[$cnt] = $_SESSION['UserGroupID'];
            $cnt++;
            $filterData[$cnt] = 1;
            $cnt++;

            $getFavMenu = $this->db->fetchSQL("SELECT A.MenuID, A.Menu, A.URL, A.MenuDesc FROM tbl_Menu A, tbl_FavMenu B WHERE A.MenuID = B.MenuID AND B.UserID = :filter0 AND B.UserGroupID = :filter1 AND A.Active = :filter2 ORDER BY Sort ASC", $filterData, "1");
            
            return $getFavMenu;
        }

        /*********************************************************************************************/
        /***********Used to get the count of menus for each category as per user group****************/
        /*********************************************************************************************/

        function cntMenu($menuCategoryID)
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = $menuCategoryID;
            $cnt++;
            $filterData[$cnt] = $_SESSION['GroupID'];
            $cnt++;
            $filterData[$cnt] = 'A';
            $cnt++;

            $cntMenu = $this->db->countRows("SELECT count(A.MenuID) AS totalMenu FROM tbl_Menu A, as_MenuGroup B WHERE A.Active = :filter0 AND A.MenuCategoryID = :filter1 AND A.MenuID = B.MenuID AND B.GroupID = :filter2 AND B.MenuGroupStatus = :filter3", $filterData, "1");
            
            return $cntMenu;
        }

        /*********************************************************************************************/
        /****************Used to get the menu options for each menu category    **********************/
        /*********************************************************************************************/

        function getMenu($menuCategoryID)
        {
            $filterData = array();
            $cnt = 0;
            $filterData[$cnt] = 1;
            $cnt++;
            $filterData[$cnt] = $menuCategoryID;
            $cnt++;
            $filterData[$cnt] = $_SESSION['GroupID'];
            $cnt++;
            $filterData[$cnt] = 'A';
            $cnt++;
            //echo "SELECT A.MenuID, A.Menu, A.URL, A.MenuDesc FROM tbl_Menu A, as_MenuGroup B WHERE A.Active = :filter0 AND A.MenuCategoryID = :filter1 AND A.MenuID = B.MenuID AND B.GroupID = :filter2 ORDER BY Sort ASC";

            $getMenu = $this->db->fetchSQL("SELECT A.MenuID, A.Menu, A.URL, A.MenuDesc, A.MenuVideo FROM tbl_Menu A, as_MenuGroup B WHERE A.Active = :filter0 AND A.MenuCategoryID = :filter1 AND A.MenuID = B.MenuID AND B.GroupID = :filter2 AND B.MenuGroupStatus = :filter3 ORDER BY Sort ASC", $filterData, "5");
            
            return $getMenu;
        }

    }
?>