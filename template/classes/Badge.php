<?php
    global $connection;
    include_once('DBConnection.php');

    class Badge
    {

        // property declaration
        public $id;
        public $imgURL;
        public $name;
        public $description;
        public $value;
        public $categoryID;
        public $bgColor;
        public $borderColor;
        public $special;
        public $transtag;

          	            
        
        // Get answer from id
        public function getBadge($ID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $badge = new Badge;
            $query = "SELECT * from tblBadge WHERE id=".$ID."";
            $result = mysqli_query($connection, $query);
                
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    // Get basic question info
                    $badge->id = $row[0];
                    $badge->imgURL = "img/badge/".$row[1];
                    $badge->name = $row[2];
                    $badge->description = $row[3];
                    $badge->value = $row[4];
                    $badge->categoryID = $row[5];
                    $badge->bgColor = "#".$row[6];
                    $badge->borderColor = "#".$row[7];
                    $badge->transtag = $row[9];
                }
                return $badge;
            }
        
        }

        // Get all badges from category, 0 for ALL
        public function getAllBadges($categoryID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $badge = new Badge;
            $badges = array();
            $query;
            if(!isset($categoryID) || $categoryID == 0)
                $query = "SELECT * from tblBadge";
            else
                $query = "SELECT * from tblBadge WHERE categoryID=".$categoryID."";
            $result = mysqli_query($connection, $query);
                
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    // Get basic question info
                    $badge = new Badge;
                    $badge->id = $row[0];
                    $badge->imgURL = "img/badges/".$row[1];
                    $badge->name = $row[2];
                    $badge->description = $row[3];
                    $badge->value = $row[4];
                    $badge->categoryID = $row[5];
                    $badge->bgColor = "#".$row[6];
                    $badge->borderColor = "#".$row[7];
                    $badge->special = $row[8];
                    $badge->transtag = $row[9];
                    $badges[] = $badge;
                }
                return $badges;
            }
        }

        public function AddToUser($badgeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "Insert into tblUserBadge (userID, badgeID) VALUES (".$userID.",".$badgeID.");";
            $result = mysqli_query($connection, $query);
        }

        public function MarkAsSeen($badgeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblUserBadge SET seen=1 WHERE userID='".$userID."' AND badgeID=".$badgeID.";";
            $result = mysqli_query($connection, $query);
        }

    }
?>
