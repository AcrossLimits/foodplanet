<?php

global $connection;
include_once('DBConnection.php');
include_once('Badge.php');

class BadgeManager
{        
    public function Validate($userID, $categoryID) {
        $cid;
        $badge = new Badge;
        
        // Get the categoryID
        if(isset($categoryID))
            $cid = $categoryID;
        else
            $cid = 0;

        // Get all badges the user hasnt obtained yet
        $badgeIDs = array();
        $badgeIDs = $this->GetAllUnobtained($userID, $cid);

        // Create an array to hold any badge ID's the user might obtain during this validation
        $newlyObtained = array();

        // Foreach badge, validate individually
        foreach($badgeIDs as $id) {
            $obtained = FALSE;
            $obtained = $this->ValidateBadge($id, $userID);
            if($obtained) {
                $newlyObtained[] = $badge->getBadge($id);

                // Add the badge to the user
                $badge->AddToUser($id, $userID);
                
            }
        }

        return $newlyObtained;

    }    

    // Get all badge IDs
    public function GetBadgeIDs($categoryID) {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);
        $query = "";

        $badgeIDs = array();

        if($categoryID == 0)
            $query = "SELECT id FROM tblBadge WHERE 1;";
        else
            $query = "SELECT id FROM tblBadge WHERE categoryID='.$categoryID.'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            return NULL;
	    }
        else {
            $fullData = array();
	        while($row = mysqli_fetch_array($result) ){                
                $badgeIDs[] = intval($row[0]);
            }
            return $badgeIDs;                    
        }
    }


    // Get all badges the user has obtained but not yet seen
    public function GetAllUnseen($userID) {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);
        $query = "SELECT badgeID FROM tblUserBadge WHERE userID='".$userID."' AND seen=0";
        $badge = new Badge;
        $badgeIDs = array();
        $newlyObtained = array();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            return NULL;
	    }
        else {
            $fullData = array();
	        while($row = mysqli_fetch_array($result) ){                
                $badgeIDs[] = intval($row[0]);
            }
                            
        }

        // Foreach badge, validate individually
        foreach($badgeIDs as $id) {
            $obtained = FALSE;
            $obtained = $this->ValidateBadge($id, $userID);
            if($obtained) {
                $newlyObtained[] = $badge->getBadge($id);
                
            }
        }

        return $newlyObtained;
    }
    

    

    // Get all badges the user has not yet obtained
    public function GetAllUnobtained($userID, $categoryID) {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);
        $query = "";

        $badgeIDs = array();

        if($categoryID == 0)
            $query = "SELECT A.id, A.name FROM tblBadge A WHERE A.id NOT IN (SELECT B.badgeID FROM tblUserBadge B WHERE B.userID = '".$userID."');";
        else
            $query = "SELECT A.id, A.name FROM tblBadge A WHERE A.id NOT IN (SELECT B.badgeID FROM tblUserBadge B WHERE B.userID = '".$userID."') AND A.categoryID=".$categoryID.";";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            return NULL;
	    }
        else {
            $fullData = array();
	        while($row = mysqli_fetch_array($result) ){                
                $badgeIDs[] = intval($row[0]);
            }
            return $badgeIDs;                    
        }
    }

    // Get all badges the user has not yet obtained
    public function GetAllObtained($userID) {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);

        $badgeIDs = array();


        $query = "SELECT badgeID FROM tblUserBadge WHERE userID = '".$userID."';";
         
        $result = mysqli_query($connection, $query);
        if (!$result) {
            return NULL;
	    }
        else {
            $fullData = array();
	        while($row = mysqli_fetch_array($result) ){                
                $badgeIDs[] = intval($row[0]);
            }
            return $badgeIDs;                    
        }
    }

    // Validate a specific badge
    public function ValidateBadge($badgeID, $userID) {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);
        $obtained = FALSE;
        $comparison = 0;
        $count = 0;
        $query = "";

        // If this is a Geographical Badge
        if($badgeID > 0 && $badgeID <= 14) {
            switch($badgeID) {

                // European Badge - All other European Geographical Badges
                case 1: {
                    break;
                }

                // World Leader Badge - All Geographical Badges
                case 2: {
                    break;
                }

                // Scandinavia Badge - Play against 5 different opponents from Scandinavia
                case 3: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 1";
                    $comparison = 5;
                    break;
                }
                
                // Western Europe Badge - Play against 5 different opponents from Western Europe
                case 4: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 2";
                    $comparison = 5;
                    break;
                }

                // Central Europe Badge - Play against 5 different opponents from Central Europe
                case 5: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 3";
                    $comparison = 5;
                    break;
                }

                // Eastern Europe Badge - Play against 5 different opponents from Eastern Europe
                case 6: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 4";
                    $comparison = 5;
                    break;
                }

                // The Balkans Badge - Play against 5 different opponents from the Balkans
                case 7: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 5";
                    $comparison = 5;
                    break;
                }

                // Mediterranean Badge - Play against 5 different opponents from the Mediterranean
                case 8: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 6";
                    $comparison = 5;
                    break;
                }

                // Asia Badge - Play against 5 different opponents from Asia
                case 9: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 7";
                    $comparison = 5;
                    break;
                }

                // Africa Badge - Play against 5 different opponents from Africa
                case 10: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 8";
                    $comparison = 5;
                    break;
                }

                // North / Central America Badge - Play against 5 different opponents from North / Central America
                case 11: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 9";
                    $comparison = 5;
                    break;
                }

                // Latin America Badge - Play against 5 different opponents from Latin America
                case 12: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 10";
                    $comparison = 5;
                    break;
                }

                // The Middle East Badge - Play against 5 different opponents from The Middle East
                case 13: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 11";
                    $comparison = 5;
                    break;
                }

                // Oceania Badge - Play against 5 different opponents from Oceania
                case 14: {
                    $query = "SELECT COUNT(DISTINCT OpponentID) as count FROM (SELECT A.player1ID as OpponentID from tblChallenge A WHERE A.player2ID = '".$userID."' UNION SELECT A.player2ID as OpponentID from tblChallenge A WHERE A.player1ID = '".$userID."') as table1 INNER JOIN tblUser B on OpponentID=B.id INNER JOIN tblCountry C on B.countryID = C.id INNER JOIN tblCountryRegion D on B.countryID = D.countryID INNER JOIN tblRegion E on D.regionID = E.id WHERE OpponentID != '".$userID."' AND OpponentID != 'na' AND E.id = 12";
                    $comparison = 5;
                    break;
                }
            }
        }

        // If this is an Upload Badge
        else if ($badgeID > 14 && $badgeID <= 19){
            switch($badgeID) {

                // Master Chef Badge - Upload 25 Meals
                case 15: {
                    $comparison = 25;
                    break;
                }

                // Kitchen Assistant Badge - Upload 1 Meal
                case 16: {
                    $comparison = 1;
                    break;
                }

                // Fry Cook Badge - Upload 2 Meals
                case 17: {
                    $comparison = 2;
                    break;
                }

                // Grill Cook Badge - Upload 5 Meals
                case 18: {
                    $comparison = 5;
                    break;
                }

                // Executive Chef Badge - Upload 10 Meals
                case 19: {
                    $comparison = 10;
                    break;
                }
            }
            $query = "SELECT COUNT(*) FROM tblQuestion WHERE authorID='".$userID."' AND statusID = 1";
        }

        // If this is a Challenge Badge
        else if ($badgeID > 19 && $badgeID <= 33){

            // If this is a badge for amount of challenges won
            if ($badgeID > 19 && $badgeID <= 24){
                switch($badgeID) {

                    // Master Badge - Win 50 Challenges
                    case 20: {
                        $comparison = 50;
                        break;
                    }

                    // Rookie Badge - Win 1 Challenge
                    case 21: {
                        $comparison = 1;
                        break;
                    }

                    // Amateur Badge - Win 5 Challenges
                    case 22: {
                        $comparison = 5;
                        break;
                    }

                    // Semi Pro Badge - Win 10 Challenges
                    case 23: {
                        $comparison = 10;
                        break;
                    }

                    // Pro Badge - Win 25 Challenges
                    case 24: {
                        $comparison = 25;
                        break;
                    }
                }
                $query = "SELECT COUNT(*) FROM tblChallengeWins WHERE winnerID='".$userID."'";
            }

            // If this is a badge for amount of challenges won in a row
            else if ($badgeID > 24 && $badgeID <= 27){
                switch($badgeID) {

                    // 5-in-a-row Badge - Win 5 Challenges in a row
                    case 25: {
                        $comparison = 5;
                        break;
                    }

                    // 10-in-a-row Badge - Win 10 Challenges in a row
                    case 26: {
                        $comparison = 10;
                        break;
                    }

                    // 25-in-a-row Badge - Win 25 Challenges in a row
                    case 27: {
                        $comparison = 25;
                        break;
                    }
                }
                $query = "SELECT B.winnerID as WinnerID, A.id, A.date, A.player1ID as P1, A.player2ID as P2 FROM tblChallenge A INNER JOIN tblChallengeWins B ON A.id = B.challengeID WHERE A.player1ID = '".$userID."' OR A.player2ID = '".$userID."' ORDER BY A.date DESC LIMIT ".$comparison.";";

            }

            // If this is a badge for amount of questions answered correctly in a row
            else if ($badgeID > 27 && $badgeID <= 30){
                switch($badgeID) {

                    // 5 Questions Badge - Answer 5 questions correctly in a row
                    case 28: {
                        $comparison = 5;
                        break;
                    }

                    // 10 Questions Badge - Answer 10 questions correctly in a row
                    case 29: {
                        $comparison = 10;
                        break;
                    }

                    // 25 Questions Badge - Answer 25 questions correctly in a row
                    case 30: {
                        $comparison = 25;
                        break;
                    }
                }
                $query = "SELECT B.score as score, A.id, A.date, B.playerID FROM tblChallenge A INNER JOIN tblChallengeQuestionScore B ON A.id = B.challengeID WHERE B.playerID = '".$userID."' ORDER BY A.date DESC LIMIT 25;";
            }

            // If this is a badge for amount of shares
            else {
                switch($badgeID) {

                    // 1 Share Badge - Share 1 meal
                    case 31: {
                        $comparison = 1;
                        break;
                    }

                    // 5 Shares Badge - Share 5 meals
                    case 32: {
                        $comparison = 5;
                        break;
                    }

                    // 10 Shares Badge - Share 10 meals
                    case 33: {
                        $comparison = 10;
                        break;
                    }
                }
                $query = "SELECT shares as shares from tblUser WHERE id='".$userID."'";
            }
            
        }

        // If this is a badge which hasnt been introduced yet
        else {
            // .. do nothing
        }

        
        if($query != "") {
            // Submit the query
            $result = mysqli_query($connection, $query);
            
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
                $max = 0;
	            while($row = mysqli_fetch_array($result) ){    
                    
                    // If this is any of the count queries  
                    if(($badgeID > 0 && $badgeID < 25) || ($badgeID > 30 && $badgeID < 34)) {          
                        $count = intval($row[0]);
                    }

                    // Otherwise if this is a query which needs additional working out
                    else {
                        // If this is a badge for challenges won in a row
                        if($badgeID > 24 && $badgeID <= 27) {
                            $winnerID = $row[0];
                            if($winnerID == $userID) {
                                $count++;
                                if($count > $max)
                                    $max = $count;
                            }
                            else {
                                $count = 0;
                            }
                        }

                        // If this is a badge for questions in a row
                        else if($badgeID > 27 && $badgeID <= 30) {
                            $score = intval($row[0]);
                            if($score > 0) {
                                $count++;
                                if($count > $max) {
                                    $max = $count;
                                }
                            }
                            else {
                                $count = 0;
                            }

                        }

                        // If this is a badge for shares
                        else if($badgeID > 30 && $badgeID <= 33) {
                            $count = intval($row[0]);
                            
                        }

                        // Otherwise
                        else {
                            // do nothing
                        }
                    }
                }  
                
                // If this is a query which needed additional processing
                if(($badgeID > 24 && $badgeID <= 27) || ($badgeID > 27 && $badgeID <= 30)) {
                    $count = $max;
                }             

                // FINALLY
                // If $count>=comparrison, we've unlocked the badge
                if($count>=$comparison) {
                    $obtained = TRUE;
                }

            }

        }
        else
            $obtained = FALSE;
        return $obtained;
    }
}

?>

