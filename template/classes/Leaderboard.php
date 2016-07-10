<?php

    global $connection;
    include_once('DBConnection.php');
    include_once('LeaderboardItem.php');

    /*
        TOP POINTS THIS WEEK
        SELECT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(*) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges  from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 AND WEEKOFYEAR(C.acceptedDate)=WEEKOFYEAR(NOW()) GROUP BY A.id ORDER BY points DESC LIMIT 10;

        TOP POINTS ALL TIME
        SELECT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(*) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges  from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 GROUP BY A.id ORDER BY points DESC LIMIT 10;
    */

    class Leaderboard
    {        
        // Select top $amountPlayers players by points this week
        public function getTopPointsWeek($amountPlayers) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $li = new LeaderboardItem;
            $leaders = array();
			$dw = date("w");
			$dateInterval = ($dw+1);
            $query = "SELECT DISTINCT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(DISTINCT challengeID) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges  from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 AND C.date >= DATE_SUB(DATE(NOW()), INTERVAL ".$dateInterval." DAY) GROUP BY A.id HAVING points > 0 ORDER BY points DESC LIMIT ".$amountPlayers."";
            $result = mysqli_query($connection, $query);
            //var_dump($result);

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){
                    $li = new LeaderboardItem;
                    $li->playerID = $row[0];
                    $li->name = $row[1];
                    $li->surname = $row[2];
                    $li->wins = $row[4];
                    $li->badges = $row[5];
                    $li->points = $row[3];
                    $leaders[] = $li;
                }
            }

            return $leaders;

        }

        // Select top $amountPlayers players by points of all time
        public function getTopPointsAllTime($amountPlayers) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            
            $leaders = array();
            $query = "SELECT DISTINCT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(DISTINCT challengeID) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges  from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 GROUP BY A.id HAVING points > 0 ORDER BY points DESC LIMIT ".$amountPlayers."";
            $result = mysqli_query($connection, $query);
            //var_dump($result);

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){
                    $li = new LeaderboardItem;
                    $li->playerID = $row[0];
                    $li->name = $row[1];
                    $li->surname = $row[2];
                    $li->wins = $row[4];
                    $li->badges = $row[5];
                    $li->points = $row[3];
                    $leaders[] = $li;
                }
            }

            return $leaders;

        }

        // Select top $amountPlayers players by wins this week
        public function getTopWinsWeek($amountPlayers) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $li = new LeaderboardItem;
            $leaders = array();
			$dw = date("w");
			$dateInterval = ($dw+1);
            $query = "SELECT DISTINCT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(DISTINCT challengeID) FROM tblChallengeWins WHERE winnerID=A.id AND WEEKOFYEAR(dateWon)=WEEKOFYEAR(NOW()) ) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 AND  C.date >= DATE_SUB(DATE(NOW()), INTERVAL ".$dateInterval." DAY) GROUP BY A.id HAVING wins > 0 ORDER BY wins DESC LIMIT ".$amountPlayers."";            
            $result = mysqli_query($connection, $query);
            

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){

                    $li = new LeaderboardItem;
                    $li->playerID = $row[0];
                    $li->name = $row[1];
                    $li->surname = $row[2];
                    $li->wins = $row[4];
                    $li->badges = $row[5];
                    $li->points = $row[3];
                    $leaders[] = $li;
                }
            }
            return $leaders;

        }

        // Select top $amountPlayers players by wins of all time
        public function getTopWinsAllTime($amountPlayers) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            
            $leaders = array();
            $query = "SELECT DISTINCT A.id as playerID, A.name as playerName, A.surname as playerSurname, SUM(B.score) as points, (SELECT COUNT(DISTINCT challengeID) FROM tblChallengeWins WHERE winnerID=A.id) as wins, (SELECT COUNT(*) FROM tblUserBadge WHERE userID=A.id) as badges from tblUser A INNER JOIN tblChallengeScore B on A.id = B.playerID INNER JOIN tblChallenge C on B.challengeID = C.id WHERE A.statusID != 3 GROUP BY A.id HAVING wins > 0 ORDER BY wins DESC LIMIT ".$amountPlayers."";
            $result = mysqli_query($connection, $query);
            //var_dump($result);

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){
                    $li = new LeaderboardItem;
                    $li->playerID = $row[0];
                    $li->name = $row[1];
                    $li->surname = $row[2];
                    $li->wins = $row[4];
                    $li->badges = $row[5];
                    $li->points = $row[3];
                    $leaders[] = $li;
                }
            }
            return $leaders;
        }
    }
?>
