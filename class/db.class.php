<?php

    class db 
    {
        private $database;
        private $host;
        private $username;
        private $password;
        private $con;
        private $pdo;

        public function __construct()
        {
            if ($_SERVER['SERVER_NAME'] == "localhost")
            {
                $this->database = "dynamicDatabase";
                $this->host = "localhost";
                $this->username = "root";
                $this->password = "";
            }
            else
            {
                $this->database = "dtsDB100";
                $this->host = "dtsDB100.db.6436345.hostedresource.com";
                $this->username = "dtsDB100";
                $this->password = "dtsDB100@";
            }

            $conStr = "host={$this->host};dbname={$this->database}";
            
            try
            {
                $this->pdo = new PDO( "mysql:$conStr", $this->username, $this->password );
                $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            }
            catch( PDOException $e ) 
            {
                echo "error ". $e->getMessage();
            }
        }

        public function fetch_single_row($sql, $data)
        {
            $sel = $this->pdo->prepare( $sql );
            $sel->execute( array(':filter0' => $data[0] ));
            $sel->setFetchMode( PDO::FETCH_OBJ );
            $obj = $sel->fetch();
            return $obj;
        }
    
        /************************************************************************************************/
        /*******************Used to execute the update sql.                            ******************/
        /************************************************************************************************/
        
        public function updateSQL($sql, $data)
        {   
            $sel = $this->pdo->prepare( $sql );
            
            for ($i=0; $i< count($data); $i++)
            {
                $sel->bindParam(':filter' . $i, $data[$i]);
            }
        
            try {
                $sel->execute();
                return true;                
            } catch(PDOException $e){
                die($e->getMessage());
            }   
        }

        /************************************************************************************************/
        /*******************Used to execute the sql query based on the filter criteria.******************/
        /************************************************************************************************/
        
        public function fetchSQL($sql, $data, $colCnt)
        {   
            $returnListArray = array(array());
            $cnt = 0;
        
            $sel = $this->pdo->prepare( $sql );
            
            for ($i=0; $i< count($data); $i++)
            {
                $sel->bindParam(':filter' . $i, $data[$i]);
            }
        
            $sel->execute();
            
            if ($sel->rowCount() > 0) 
            {
                foreach($sel as $returnLists)
                {
                    for ($i=0; $i< $colCnt; $i++)
                    {
                        $returnListArray[$cnt][$i] = $returnLists[$i];
                    }
                    $cnt++;
                }
            }
        
            return $returnListArray;
        }
        
        /************************************************************************************************/
        /*****************Used to count the number of rows returned for a select query.******************/
        /************************************************************************************************/
        
        public function countRows($sql, $data, $colCnt)
        {   
            $returnListCnt = 0;
            $cnt = 0;
        
            $sel = $this->pdo->prepare( $sql );
            
            for ($i=0; $i< count($data); $i++)
            {
                $sel->bindParam(':filter' . $i, $data[$i]);
            }
        
            try{
                $sel->execute();
                $rows = $sel->fetch(PDO::FETCH_NUM);
                $returnListCnt = $rows[0];
        
                return $returnListCnt;
            } catch (PDOException $e){
                die($e->getMessage());
            }
        }
    }
?>