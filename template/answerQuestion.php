<?php
session_start();

include_once('classes/Menu.php');
include_once('classes/User.php');
include_once('classes/Challenge.php');
include_once('classes/BadgeManager.php');
$menu = new Menu;    
$user = new User;
$badgeManager = new BadgeManager;


if ($_SESSION['FBID']) {
    
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {
        $user = $user->getUser($uid);
        $menu->create($user);

        // If the user has been banned, redirect them
        if($user->statusID == 3) {
            header("Location: banned.php");
        }
    }
    else {
        $user->createGuest();
    }
    // Get the challenge
    $challenge = new Challenge;
    $question = new Question;
    $challenge = $challenge->getChallenge($_SESSION['CHALLENGEID']);
    $currentQuestion = $_SESSION['CHALLENGECURQUESTION'];
    

    // Otherwise get the current question
    $question = $question->getQuestion($challenge->questionIDs[$currentQuestion-1]);

    // Save answer to question
    $challenge->answerQuestion($_SESSION['CHALLENGEID'], $uid, $challenge->questionIDs[$currentQuestion-1], intval($_GET['score']));
    $badgeManager->Validate($uid, 0);
    // if the user pressed learn mre redirect there, else move on to next question
    if (isset($_REQUEST['learn']))
    {
        // Move on to the next round
        header("Location: learnMore.php?qid=".$question->id."&option=1");
    }
    else
    {
        // Move on to the next round
        header("Location: challenge.php");
    }
    
    
}
else {
    header("Location: login.php");
} 
?>