<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    include('classes/GameManager.php');
    $gameManager = new GameManager;

    // Everything here will run after being called by the server every 60 minutes
    
    // Reset all games that have been occupied for over an hour
    //echo "Reset games occupied for over an hour..";
    try{
        $gameManager->resetLongOccupiedChallenges();
        //echo "COMPLETE<br/>";
    }
    catch(Exception $e) {
        //echo "FAILED<br />";
    }
    // Time out all challenges that are over (x) hours old
    $gameManager->timeoutOldChallenges(48);

?>
