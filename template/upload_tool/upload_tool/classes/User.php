<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
    
    global $connection;
    include_once('DBConnection.php');

    class User
    {
        // property declaration
        public $id;
        public $name;
        public $surname;
        public $country;
        public $gender;
        public $currentBadgeID;
        public $statusID;
        public $pictureURL;
        public $email;
        public $dob;
        public $points = 99230;
        public $wins = 25;
        public $badges = 11;

        public function init($id, $name, $surname) {
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->pictureURL = "https://graph.facebook.com/".$id."/picture?type=large";
            //$this->points = 0;
            //$this->wins = 0;
           // $this->badges = 0;
        }        
	    
        public function getFullName() {
            return $this->name." ".$this->surname;
        } 

        public function getImageURL($userID) {
            return "https://graph.facebook.com/".$userID."/picture?type=large";
        }

        // Get user rank; return if admin or banned
        public function getRank() {
            if($this->statusID == 1) {
                return "rookie"; // Get badge name
            }
            else if($this->statusID == 2) {
                return "admin";
            }
            else if($this->statusID == 3) {
                return "banned";
            }
            else if($this->statusID == 4) {
                return "guest";
            }
        }

        // Create a basic guest
        public function createGuest() {
            $this->name = "Guest";
            $this->surname= " ";
            $this->id = 1;
            $this->pictureURL = "../img/imgGuest.png";
            $this->statusID = 4;
        }

        // Insert a new user into the database
        public function createUser($isGuest = FALSE) {
            $array = explode(' ', $this->name, 2);
            $this->name = $array[0];
            $this->surname = $array[1];
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            $query = "INSERT INTO tblUser (id, name, surname, email, country, gender, dob) VALUES ('".$this->id."','".$this->name."','".$this->surname."','".$this->email."','".$this->country."','".$this->gender."','".$this->dob."')";
            mysqli_query($connection, $query);
        }

        // Check to see if user exists in database
        public function checkIfExists($userID) {
            $value;
            echo "CHECK IF USER EXISTS<br>";
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "SELECT Count(*) from tblUser WHERE id='".$userID."'";
            $result = mysqli_query($connection, $query);
            $result_array = mysqli_fetch_array($result);
            $count = $result_array[0];

            if($count > 0)
                return true;
            else
                return false;
        }

        // Get user by ID
        public function getUser($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $user = new User;
                $query = "SELECT * from tblUser WHERE id=".$userID."";
                $result = mysqli_query($connection, $query);
                
                if (!$result) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        $user->id = $row[0];
                        $user->name = $row[1];
                        $user->surname = $row[2];
                        $user->country = $row[3];
                        $user->gender = $row[4];
                        $user->currentBadgeID = $row[5];
                        $user->statusID = $row[6];
                        $user->dob = $row[7];
                        $user->email = $row[8];
                        $user->pictureURL = "https://graph.facebook.com/".$user->id."/picture?type=large";
                    }
                    return $user;                    
                }
        }

        // Get users points
        public function getPoints($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $points = 0;
            try {
                $query = "SELECT SUM(score) FROM tblChallengeScore WHERE playerID='$userID'";
                $result = mysqli_query($connection, $query);
                if ($result=="null") {
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        
                        // Get basic question info
                        $points = intval($row[0]);
                        
                    }                  
                }
            }
            
            catch(Exception $e) {
                $points = 0;
            }

            return $points; 
        }

        // Get users wins
        public function getWins($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $wins = 0;
            try {
                $query = "SELECT COUNT(DISTINCT challengeID) FROM tblChallengeWins WHERE winnerID='$userID'";
                $result = mysqli_query($connection, $query);
                if ($result=="null") {
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        
                        // Get basic question info
                        $wins = intval($row[0]);
                        
                    }                  
                }
            }
            
            catch(Exception $e) {
                $wins = 0;
            }

            return $wins; 
        }

        // Get users badges
        public function getBadges($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $badges = 0;
            try {
                $query = "SELECT COUNT(*) FROM tblUserBadge WHERE userID='$userID'";
                $result = mysqli_query($connection, $query);
                if ($result=="null") {
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        
                        // Get basic question info
                        $badges = intval($row[0]);
                        
                    }                  
                }
            }
            
            catch(Exception $e) {
                $badges = 0;
            }

            return $badges; 
        }

        // Ban user
        public function ban($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblUser SET statusID=3 WHERE id='".$userID."';";
            $result = mysqli_query($connection, $query);
        }

        // Unban user
        public function unban($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblUser SET statusID=1 WHERE id='".$userID."';";
            $result = mysqli_query($connection, $query);
        }

        // Make user an admin
        public function makeAdmin($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblUser SET statusID=2 WHERE id='".$userID."';";
            $result = mysqli_query($connection, $query);
        }
    }
?>
