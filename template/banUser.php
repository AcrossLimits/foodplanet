<?php
session_start();

global $connection;
include_once('DBConnection.php');

include('classes/User.php');
include_once('classes/Question.php');
$user = new User;
$question = new Question;

if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    $user = $user->getUser($uid);

    if($user->statusID != 2)
        header("Location: page.php#dashboard");

    $qid = 0;
    $banUser = new User;
    $userStatus = 0;
    $loc = 0;

    // If loc is set, get where the page should redirect to after the ban
    if(isset($_GET['loc'])) {
        $loc = intval($_GET['loc']);
      
    }

    // If qid is set then we first need to get the userID via the author of the question
    if(isset($_GET['qid'])) {
        $qid = $_GET['qid'];

        // Get user
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);

        $query = "SELECT * FROM tblQuestion WHERE id=".$qid.";";
        $result = mysqli_query($connection, $query);
                
            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){
                    // Get question author
                    $banUser = $banUser->getUser($row[1]);
                }
            }     
    }
    
    else
        header("Location: page.php#verify");

    // If the user is not an admin, ban them
    if($banUser->statusID != 2) {
        $banUser->ban($banUser->id);
        if($loc == 1) {
            
            // if this is coming from the verifyUploaded page, also reject all pending submissions from this user
            $question->rejectAllPendingFromUser($banUser->id);

            header("Location: page.php#verify");
        }
        else
            header("Location: page.php#dashboard");

    }
    else {
        if($loc == 1)
            header("Location: page.php#verify");
        else
            header("Location: page.php#dashboard");
    }

}
else {
    header("Location: login.php");
} 
?>