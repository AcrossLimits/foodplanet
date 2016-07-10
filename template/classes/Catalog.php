<?php

    global $connection;
    include_once('DBConnection.php');
    include_once('CatalogItem.php');

    /*
        TOP POINTS THIS WEEK
        SELECT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(*) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges  from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 AND WEEKOFYEAR(C.acceptedDate)=WEEKOFYEAR(NOW()) GROUP BY A.id ORDER BY points DESC LIMIT 10;

        TOP POINTS ALL TIME
        SELECT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(*) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges  from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 GROUP BY A.id ORDER BY points DESC LIMIT 10;
    */

    class Catalog
    {        
        // Get all seen items, sorted alphabetcally
        public function getCatalogAZ($playerID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $ci = new CatalogItem;
            $items = array();
            $query = "SELECT A.questionID, B.imgName, B.title, D.text, D.imgURL FROM tblChallengeQuestionScore A INNER JOIN tblQuestion B ON A.questionID = B.id INNER JOIN tblQuestionAnswer C ON A.questionID = C.questionID INNER JOIN tblAnswer D ON C.answerID = D.id WHERE A.playerID = '".$playerID."' GROUP BY A.questionID ORDER BY B.title ASC;";
            $result = mysqli_query($connection, $query);
            //var_dump($result);

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){
                    $ci = new CatalogItem;
                    $ci->itemID = $row[0];
                    $ci->imageURL = $row[1];
                    $ci->itemName = $row[2];
                    $ci->countryName = $row[3];
                    $ci->flagURL = $row[4];
                    $items[] = $ci;
                }
            }

            return $items;

        }

        public function getCatalogCountry($playerID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $ci = new CatalogItem;
            $items = array();
            $query = "SELECT A.questionID, B.imgName, B.title, D.text, D.imgURL FROM tblChallengeQuestionScore A INNER JOIN tblQuestion B ON A.questionID = B.id INNER JOIN tblQuestionAnswer C ON A.questionID = C.questionID INNER JOIN tblAnswer D ON C.answerID = D.id WHERE A.playerID = '".$playerID."' GROUP BY A.questionID ORDER BY D.text ASC, B.title ASC;";
            $result = mysqli_query($connection, $query);
            //var_dump($result);

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){
                    $ci = new CatalogItem;
                    $ci->itemID = $row[0];
                    $ci->imageURL = $row[1];
                    $ci->itemName = $row[2];
                    $ci->countryName = $row[3];
                    $ci->flagURL = $row[4];
                    $items[] = $ci;
                }
            }

            return $items;

        }

        public function getCatalogAZFromSession() {
            // Start session
            session_start();
            try {
                $rawSessionData = $_SESSION["questionIDString"];
                $questionIDS = explode(",", $rawSessionData);
                $whereString = "A.id = ".$questionIDS[0];
                foreach ($questionIDS as $qIDS) {
                    if($qIDS != "" && isset($qIDS) && $qIDS != NULL) {
                        $whereString .= " OR A.id = $qIDS";
                    }
                }

                $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                $database = mysqli_select_db($connection, DB_DATABASE);
                $ci = new CatalogItem;
                $items = array();
                $query = "SELECT DISTINCT A.id, A.imgName, A.title, C.text, C.imgURL FROM tblQuestion A INNER JOIN tblQuestionAnswer B ON A.id = B.questionID INNER JOIN tblAnswer C ON B.answerID = C.id WHERE $whereString GROUP BY A.id ORDER BY A.title ASC;";
                $result = mysqli_query($connection, $query);
                //var_dump($result);

                if (!$result) {
                        echo "none";
                        return NULL;
	                }
                else {
                    while($row = mysqli_fetch_array($result) ){
                        $ci = new CatalogItem;
                        $ci->itemID = $row[0];
                        $ci->imageURL = $row[1];
                        $ci->itemName = $row[2];
                        $ci->countryName = $row[3];
                        $ci->flagURL = $row[4];
                        $items[] = $ci;
                    }
                }

                return $items;
            }
            catch (Exception $e) {
                return NULL;
            }
        
    }

    public function getCatalogCountryFromSession() {
        // Start session
    session_start();
            try {
                $rawSessionData = $_SESSION["questionIDString"];
                $questionIDS = explode(",", $rawSessionData);
                echo "&nbsp";
                $whereString = "A.id = ".$questionIDS[0];
                foreach ($questionIDS as $qIDS) {
                    if($qIDS != "" && isset($qIDS) && $qIDS != NULL) {
                        $whereString .= " OR A.id = $qIDS";
                    }
                }
                $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                $database = mysqli_select_db($connection, DB_DATABASE);
                $ci = new CatalogItem;
                $items = array();
                $query = "SELECT DISTINCT A.id, A.imgName, A.title, C.text, C.imgURL FROM tblQuestion A INNER JOIN tblQuestionAnswer B ON A.id = B.questionID INNER JOIN tblAnswer C ON B.answerID = C.id WHERE $whereString GROUP BY A.id ORDER BY C.text ASC, A.title ASC;";
                $result = mysqli_query($connection, $query);
                //var_dump($result);

                if (!$result) {
                        echo "none";
                        return NULL;
	                }
                else {
                    while($row = mysqli_fetch_array($result) ){
                        $ci = new CatalogItem;
                        $ci->itemID = $row[0];
                        $ci->imageURL = $row[1];
                        $ci->itemName = $row[2];
                        $ci->countryName = $row[3];
                        $ci->flagURL = $row[4];
                        $items[] = $ci;
                    }
                }

                return $items;
            }
            catch (Exception $e) {
                return NULL;
            }
        }
    }
?>
