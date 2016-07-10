<?php
session_start();

$state = 0;

$currentText;

include('classes/User.php');
include_once('classes/Challenge.php');
$user = new User;


if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {
        $user = $user->getUser($uid);

        // If the user has been banned, redirect them
        if($user->statusID == 3) {
            header("Location: banned.php");
        }
    }
    else {
        $user->createGuest();
    }
    $challenge = new Challenge;


    
    // Try and find an active challenge
    $challenge = $challenge->getActiveChallenge($user->id);

    // If found, accept the challenge
    if($challenge->id != NULL) {
        $challenge->acceptChallenge($challenge->id, $user->id);

        // Save the challenge info to the session
        $challenge->saveChallengeToSession(0);

        $state = 1;

        // Move on
        //header("Location: startChallenge.php");
    }

    // Otherwise 
    else {
         // If the user isnt a Guest, create a challenge
         if($uid != 'Guest') {
            // Create a challenge and get the id number of it
            $createID = $challenge->createChallenge($user->id, $amountQuestions);
            $challenge = $challenge->getChallenge($createID);
            $challenge->saveChallengeToSession(0);
            $state = 2;
         }

         // Otherwise return to dashboard
         else {
             $state = 3;
         }
        //header("Location: createChallenge.php");
    }

    
        
}
else {
    header("Location: login.php");
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="AcrossLimits">
        <title>Europeana Food & Drink</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/loadChallenge.css">       
    </head>
    <body>
        
        <div class="loadWrapper">
            <div id="text" class="text">Finding Opponent</div>
            <div class="loader"></div>
        </div>
   
        <script type="text/javascript">
            var counter = 0;
            var delay = 5;
            var state = <?php echo $state; ?>;
            var jsState = 2;

            function update() {

                if (counter < delay) {
                    counter += 1;
                }
                else {
                    var temp = document.getElementById('text');
                    var newText = "";

                    // Connecting State 
                    if (jsState == 2 && state == 1) {
                        newText = "Connecting";
                        delay = 4;
                        jsState = 4;
                    }

                    // No Game found state
                    else if (jsState == 2 && state == 2) {
                        newText = "No Game Found";
                        delay = 1;
                        jsState++;
                    }

                    // Creating Game state
                    else if(jsState == 3){
                        newText = "Creating Game";
                        delay = 4;
                        jsState = 5;
                        
                    }

                    else if(jsState == 4) {
                        newText = "Connecting";
                        window.location="startChallenge.php";
                    }

                    else if(state == 3) {
                        if(jsState == 6) {
                            window.location="dashboard.php";
                        }
                        
                        else {
                            newText = "Cannot create a challenge as a guest";
                            delay = 4;
                            jsState = 6;
                        }
                    }


                    else {
                        newText = "Creating Game";
                        window.location="createChallenge.php";
                    }

                    counter = 0;
                    temp.innerHTML = newText;
                }
                timeoutMyOswego = setTimeout(update, 500);

            }
            update();
        </script>
        <script src="js/fontScaler.js"></script>   
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>      
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        
    </body>
</html>