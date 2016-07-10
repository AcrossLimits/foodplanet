<?php


    // MAIN FUNCTIONS THAT CONTROL THE GAME'S SETTINGS

    global $connection;
    include_once('DBConnection.php');

    class GameManager
    {       
        // TRUE - MAINTENANCE MODE / FALSE - NORMAL MODE 
        public static $MAINTENANCE = FALSE;

        // Reset all games that have been occupied for over an hour
        public function resetLongOccupiedChallenges() {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblChallenge SET challengestatusID=1, player2ID='na' WHERE challengestatusID = 4 AND acceptedDate < DATE_SUB(now(), INTERVAL 1 HOUR);";
            $result = mysqli_query($connection, $query);
        }

        // Time out all challenges that are over $ageInHours hours old
        public function timeoutOldChallenges($ageInHours) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblChallenge SET challengestatusID=3 WHERE challengestatusID = 1 AND date < DATE_SUB(now(), INTERVAL ".$ageInHours." HOUR);";
            $result = mysqli_query($connection, $query);
        }
    }
?>
