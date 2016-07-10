<?php
session_start();

include('classes/User.php');
include_once('classes/Question.php');
$user = new User;
$question = new Question;





if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    $user = $user->getUser($uid);

    // If the user has been banned, redirect them
    if($user->statusID == 3) {
        header("Location: banned.php");
    }

    if($user->statusID != 2)
        header("Location: page.php#dashboard");

    $adult = 0;
    $qid = 0;

    if(isset($_GET['qid'])) {
        $qid = intval($_GET['qid']);
        echo "QuestionID: ".$qid."<br/>";
    }
    else
        header("Location: page.php#verify");

    $question->reject($qid);
        header("Location: page.php#verify");

}
else {
    header("Location: login.php");
} 
?>