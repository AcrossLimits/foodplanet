<?php



    global $connection;
    include_once('DBConnection.php');
    include_once('User.php');
    include_once('Answer.php');


    class Question
    {

        // property declaration
        public $id;
        public $author;
        public $title;
        public $description;
        public $recipe;
        public $category;
        public $status;       
        public $imgURL;   
        public $answer; 
        public $adult;
        public $authorName;     
        public $answerImage;     	            
        
        // Get question from id
        public function getQuestion($ID) {
            
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $user = new User;
            $answer = new Answer;
            $question = new Question;
            $query = "SELECT * from tblQuestion WHERE id=".$ID."";
            $result = mysqli_query($connection, $query);
                
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    // Get basic question info
                    $question->id = $row[0];
                    $question->description = $row[2];
                    $question->recipe = $row[3];
                    $question->category = $row[4];
                    $question->status = $row[5];
                    $question->title = $row[6];
                    $question->statusID = $row[6];
                    $question->imgURL = "img/questions/".$row[7];

                    // Get question author
                    $user = $user->getUser($row[1]);
                    $question->author = $user;
                }

                // Get answer 
                $query2 = "SELECT * from tblQuestionAnswer WHERE questionID=".$question->id."";
                
                $result2 = mysqli_query($connection, $query2);
                if (!$result2) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result2) ){
                        // Get basic question info
                        $answer = $answer->getAnswer($row[2]);
                    }
                    $question->answer = $answer;
                    return $question;                    
                }
            }
        
        }

        // Get 3 random answers
        public function getRandomAnswers($answerID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $question = new Question;
            $query = "SELECT * from tblAnswer WHERE id!=".$answerID." ORDER BY RAND() LIMIT 3";
            $result = mysqli_query($connection, $query);
            $answer1 = new Answer;
            $answer2 = new Answer;
            $answer3 = new Answer;
            $count = 0;
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    if($count == 0) {
                        $answer1 = $answer1->getAnswer($row[0]);
                    }
                    elseif ($count == 1) {
                        $answer2 = $answer2->getAnswer($row[0]);
                    }
                    else {
                        $answer3 = $answer3->getAnswer($row[0]);
                    }
                    $count = $count + 1;
                }
            }
            
            $answers = array($answer1,$answer2,$answer3);
            return $answers;
        }

        // Get all unverified questions
        public function getUnverified() {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $questions = array();
            $question = new Question;
            $query = "SELECT A.id as questionID, A.authorID as authorID, B.name as authorName, B.surname as authorSurname, A.statusID as status, A.title as title, A.imgName as image, D.text as answerName, D.imgURL as answerImage FROM tblQuestion A INNER JOIN tblUser B on A.authorID = B.id INNER JOIN tblQuestionAnswer C on A.id = C.questionID INNER JOIN tblAnswer D on C.answerID = D.id WHERE A.statusID = 2;";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                    echo "none";
                    return NULL;
	            }
            else {
                while($row = mysqli_fetch_array($result) ){
                    $question = new Question;
                    $question->id = $row[0];
                    $question->author = $row[1];
                    $question->authorName = $row[2]." ".$row[3];
                    $question->status = $row[4];
                    $question->title = $row[5];
                    $question->imgURL = $row[6];
                    $question->answer = $row[7];
                    $question->answerImage = $row[8];

                    $questions[] = $question;
                }
            }

            return $questions;

        }

        // Verify a question
        public function verify($qID, $isAdult) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblQuestion SET statusID=1, adult=".$isAdult." WHERE id=".$qID.";";
            $result = mysqli_query($connection, $query);
        }

        // Reject a question
        public function reject($qID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblQuestion SET statusID=4 WHERE id=".$qID.";";
            $result = mysqli_query($connection, $query);
        }

        // Reject all pending questions from user
        public function rejectAllPendingFromUser($userID) {
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);
            $query = "UPDATE tblQuestion SET statusID=4 WHERE authorID='".$userID."' AND statusID=2;";
            $result = mysqli_query($connection, $query);
        }
    }
?>
