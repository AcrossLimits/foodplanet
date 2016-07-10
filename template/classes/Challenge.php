<?php
    
    global $connection;
    include_once('DBConnection.php');
    include_once('Question.php');
    include_once('User.php');
    
    $amountQuestions = 5;

    class Challenge
    {        
        // property declaration
        public $id;
        public $date;
        public $questionIDs;
        public $player1;
        public $player2;
        public $statusID;
        public $challengeType;

        // Get challenge type
        public function getChallengeType($userID) {
            //echo $userID;
            //echo $this->player1->id;
            if($this->player1->id != $userID ) {
                return "versus";
            }
            else
                return "new";
        }
        
        // Get challenge by id
        public function getChallenge($ID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $challenge = new Challenge;
            $user = new User;
            $query = "SELECT * from tblChallenge WHERE id=".$ID."";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        // Get basic question info
                        $challenge->id = $row[0];
                        $challenge->date = strtotime($row[1]);
                        $challenge->statusID = $row[4];

                        // Get player 1
                        $p1 = $row[2];
                        if($p1 != "na") {
                            $user = $user->getUser($p1);
                            $challenge->player1 = $user;
                        }
                        else
                            $challenge->player1 = $p1;

                        // Get player 2
                        $p2 = $row[3];
                        if($p2 != "na") {
                            $user = $user->getUser($p2);
                            $challenge->player2 = $user;
                        }
                        else
                            $challenge->player2 = $p2;
                        
                       // Get question ID numbers
                       $challenge->questionIDs = $challenge->getChallengeQuestionIDs($row[0]);
                       $challenge->challengeType="new";
                    }
                    return $challenge;                    
                }
        }

        // Get challenge Questions
        public function getChallengeQuestionIDs($challengeID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $questionIDNumbers = "";
            $query = "SELECT * from tblChallengeQuestion WHERE challengeID=".$challengeID."";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        $questionIDNumbers.= "".$row[2].",";                                              
                    }
                    

                    
                    $questionIDNumbers = rtrim($questionIDNumbers, ",");
                    $arr = explode(",", $questionIDNumbers);

                    foreach ($arr AS $index => $value)
                        $arr[$index] = (int)$value; 
                    return $arr;
                }
        }

        // Accept Challenge
        public function acceptChallenge($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblChallenge SET player2ID=$userID, acceptedDate=now(), challengestatusID=4 WHERE id=$challengeID;";
            $result = mysqli_query($connection, $query);
        }

        // Set challenge as completed
        public function completeChallenge($challengeID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblChallenge SET challengestatusID=2 WHERE id=$challengeID;";
            $result = mysqli_query($connection, $query);
        }

        // Submit User's score in this challenge
        public function submitScore($challengeID, $userID, $score) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "INSERT INTO tblChallengeScore (challengeID, playerID, score) VALUES (".$challengeID.", '".$userID."', ".$score.")";
            $result = mysqli_query($connection, $query);
        }


        // End Challenge
        public function endChallenge($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $score = 0;
            $opponent = new User;
            $opponentScore = 0;
            $winnerID;

            // Set the challenge status as completed
            $this->completeChallenge($challengeID);

            // Calculate the players score for this challenge
            $score = $this->calculateChallengeScore($challengeID, $userID);

            // Insert the compiled score into tblChallengeScore for faster computations later on
            //$this->submitScore($challengeID, $userID, $score);

            // Get Challenge Opponent
            $opponent = $this->getChallengeOpponent($challengeID, $userID);
            $opponentScore = $this->getChallengeScore($challengeID, $opponent->id);

            // Work out who the winner is
            if($score > $opponentScore)
                $winnerID = $userID;
            else if($score < $opponentScore)
                $winnerID = $opponent->id;
            else
                $winnerID = "draw";
            
            // Submit the winner
            $seen = 0;
            $creatorID = $this->getChallengeCreator($challengeID);

            if($creatorID == $winnerID)
                $seen = 0;
            else
                $seen = 1;

            //$this->addChallengeWinner($challengeID, $winnerID, $seen);

        }

        // Get Challenge Creator
        public function getChallengeCreator($challengeID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $creatorID = 0;
            $query = "SELECT player1ID FROM tblChallenge WHERE id='$challengeID'";
            $result = mysqli_query($connection, $query);
            if ($result=="null") {
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                        
                    // Get basic question info
                    $creatorID = $row[0];
                        
                }                  
            }

            return $creatorID;
        }

        // Finish Challenge
        public function finishChallenge($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            // Set the challenge status as completed
            $query = "UPDATE tblChallenge SET challengestatusID=2 WHERE id=$challengeID;";
            $result = mysqli_query($connection, $query);

            // Calculate the players score for this challenge
            $query2 = "SELECT SUM(score) FROM tblChallengeQuestionScore WHERE challengeID=$challengeID AND playerID=$userID;";
            $result2 = mysqli_query($connection, $query2);
            $score = 0;
            if ($result2=="null") {
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result2) ){
                        
                    // Get basic question info
                    $score = intval($row[0]);
                        
                }                  
            }
            // Insert the compiled score into tblChallengeScore for faster computations later on
            $query3 = "INSERT INTO tblChallengeScore (challengeID, playerID, score) VALUES (".$challengeID.", '".$userID."', ".$score.")";
            $result3 = mysqli_query($connection, $query3);

            // Get the opponents id and score for this challenge
            $opponentID = '';
            $opponentScore = 0;

            $query4 = "SELECT * FROM tblChallengeScore WHERE challengeID='$challengeID' AND playerID!='$userID' ORDER BY score DESC LIMIT 1";
            $result4 = mysqli_query($connection, $query4);

            if ($result4=="null") {
                    return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result4) ){
                    $opponentID = $row[2];
                    $opponentScore = $row[3];
                }                                       
            }

            // Save the winner into tblChallengeWins
            $winnerID;

            if($score > $opponentScore)
                $winnerID = $userID;
            else if($score < $opponentScore)
                $winnerID = $opponentID;
            else
                $winnerID = "draw";
            //echo $winnerID;

            $query5 = "INSERT INTO tblChallengeWins (challengeID, winnerID) VALUES (".$challengeID.", '".$winnerID."')";
            $result5 = mysqli_query($connection, $query5);

        }

        // Add challenge winner
        public function addChallengeWinner($challengeID, $winnerID, $seen) {
            $date = date('Y-m-d H:i:s');
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            

            $query = "INSERT INTO tblChallengeWins (challengeID, winnerID, dateWon, seen) VALUES (".$challengeID.", '".$winnerID."', now(), ".$seen.")";
            $result = mysqli_query($connection, $query);
        }

        // Get challenge opponent
        public function getChallengeOpponent($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            $opponent = new User;
            $opponentID;

            $query = "SELECT * FROM tblChallengeScore WHERE challengeID='$challengeID' AND playerID!='$userID' LIMIT 1";
            $result = mysqli_query($connection, $query);

            if ($result=="null") {
                    return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    $opponentID = $row[2];
                }                                       
            }

            if(isset($opponentID))
                $opponent = $opponent->getUser($opponentID);
            return $opponent;

        }

        // Submit the challenge to be played by another player
        public function submitChallenge($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            // Set the challenge status
            $query = "UPDATE tblChallenge SET challengestatusID=1 WHERE id=$challengeID;";
            $result = mysqli_query($connection, $query);

            // Calculate the players score for this challenge
            $query2 = "SELECT SUM(score) FROM tblChallengeQuestionScore WHERE challengeID=$challengeID AND playerID=$userID;";
            $result2 = mysqli_query($connection, $query2);
            $score = 0;
            if ($result2=="null") {
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result2) ){
                        
                    // Get basic question info
                    $score = intval($row[0]);
                        
                }                  
            }
            // Insert the compiled score into tblChallengeScore for faster computations later on
            ////$query3 = "INSERT INTO tblChallengeScore (challengeID, playerID, score) VALUES (".$challengeID.", '".$userID."', ".$score.")";
            //$result3 = mysqli_query($connection, $query3);

        }

        // Find active challenge by other user
        public function getActiveChallenge($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $challenge = new Challenge;
            $user = new User;
            $query = "SELECT * FROM tblChallenge WHERE challengestatusID=1 AND player1ID!='$userID' AND player2ID='na' ORDER BY RAND() LIMIT 1";
            $result = mysqli_query($connection, $query);
            
                if ($result=="null") {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        // Get basic question info
                        $challenge->id = $row[0];
                        $challenge->date = strtotime($row[1]);
                        $challenge->statusID = $row[4];

                        // Get player 1
                        $p1 = $row[2];
                        if($p1 != "na") {
                            $user = $user->getUser($p1);
                            $challenge->player1 = $user;
                        }
                        else
                            $challenge->player1 = $p1;
                        
                       // Get question ID numbers
                       $challenge->questionIDs = $challenge->getChallengeQuestionIDs($row[0]);

                       // Set challenge type
                       $challenge->challengeType="versus";
                    }
                    return $challenge;                    
                }
        }

        // Create new challenge
        public function createChallenge($userID, $amount) {
            

            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            // Add an entry into the challenge table
            $query = "INSERT INTO tblChallenge (date, player1ID, challengestatusID) VALUES (now(), '".$userID."', 4)";
            $result = mysqli_query($connection, $query);
            $resultID = mysqli_insert_id($connection);
            

            // Pick $amountQuestions random questions and assign them to the challenge
            $query2 = "SELECT * FROM tblQuestion WHERE statusID=1 ORDER BY RAND() LIMIT ".$amount."";
            $result2 = mysqli_query($connection, $query2);

            if (!$result2) {
                    return NULL;
	            }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result2) ){
                    $query3 = "INSERT INTO tblChallengeQuestion (challengeID, questionID) VALUES (".$resultID.",".$row[0].")";
                    $result3 = mysqli_query($connection, $query3);
                }
            }

            return $resultID;
        }
        
        // Save Session Info
        public function saveChallengeToSession($questionID) {
            //session_start();
            $_SESSION['CHALLENGEID'] = $this->id;
            $_SESSION['CHALLENGECURQUESTION'] = $questionID;
        }

        // Answer Question
        public function answerQuestion($challengeID, $playerID, $questionID, $score) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            // Add an entry into the challenge table
            $query = "INSERT INTO tblChallengeQuestionScore (challengeID, playerID, questionID, score) VALUES (".$challengeID.",'".$playerID."',".$questionID.",".$score.")";
            $result = mysqli_query($connection, $query);
            $resultID = mysqli_insert_id($connection);
        }

        // Get opponent score on particular question
        public function getOpponentScore($questionID, $opponentID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "SELECT * FROM tblChallengeQuestionScore WHERE challengeID=".$this->id." AND playerID=".$opponentID." AND questionID=".$questionID."";
            $result = mysqli_query($connection, $query);
            $score = 0;
                if ($result=="null") {
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){
                        
                        // Get basic question info
                        $score = intval($row[4]);
                        
                    }                  
                }
                return $score;
        }

        // Calculate challenge score based on challenge points
        public function calculateChallengeScore($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            if($userID == "Guest")
                $query = "SELECT SUM(score) FROM tblChallengeQuestionScore WHERE challengeID=$challengeID AND playerID='$userID';";
            else 
                $query = "SELECT SUM(score) FROM tblChallengeQuestionScore WHERE challengeID=$challengeID AND playerID=$userID;";
            $result = mysqli_query($connection, $query);
            $score = 0;
            if ($result=="null") {
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                        
                    // Get basic question info
                    $score = intval($row[0]);
                        
                }                  
            }
            return $score;
        }

        // Get players score from particular challenge
        public function getChallengeScore($challengeID, $userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            if($userID == "Guest")
                $query = "SELECT * FROM tblChallengeScore WHERE challengeID=$challengeID AND playerID='$userID'  ORDER BY score DESC LIMIT 1;";
            else
                $query = "SELECT * FROM tblChallengeScore WHERE challengeID=$challengeID AND playerID=$userID ORDER BY score DESC LIMIT 1;";
            $result = mysqli_query($connection, $query);
            $score = 0;
            if ($result=="null") {
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                        
                    // Get basic question info
                    $score = intval($row[3]);
                        
                }                  
            }
            return $score;
        }
    }
?>
