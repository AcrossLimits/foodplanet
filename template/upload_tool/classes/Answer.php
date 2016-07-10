<?php
    global $connection;
    include_once('DBConnection.php');

    class Answer
    {

        // property declaration
        public $id;
        public $text;
        public $imgURL;
          	            
        
        // Get answer from id
        public function getAnswer($ID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $answer = new Answer;
            $query = "SELECT * from tblAnswer WHERE id=".$ID."";
            $result = mysqli_query($connection, $query);
                
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    // Get basic question info
                    $answer->id = $row[0];
                    $answer->text = $row[1];
                    $answer->imgURL = "img/answers/".$row[2];
                }
                return $answer;
            }
        
        }


    }
?>
