<?php
session_start();

include('classes/User.php');
include('classes/Challenge.php');
$user = new User;


if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    $user = $user->getUser($uid);

    // If the user has been banned, redirect them
    if($user->statusID == 3) {
        header("Location: banned.php");
    }
    $challenge = new Challenge;

    $challenge = $challenge->getChallenge($_SESSION['CHALLENGEID']);

}
else {
    header("Location: login.php");
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Mobify">
        <meta name="description" content="A responsive, mobile first accordion UI module from Mobify">
        <meta name="keywords" content="mobify,mobile,modules,ui,responsive,carousel,scooch,slider">
        <title>Europeana Food & Drink</title>
        <link rel="stylesheet" href="css/page.css">
        <link rel="stylesheet" href="css/createChallenge.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 

        

        //$user->init(0, "Peter", "Meadley");
        //$menu->create($user);

        ?>

        
    </head>
    <body>
        <div id="header">
            <div class="title">Challenge Mode</div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>
                    <div class="challengeUpper">
                        Create a challenge
                    </div>
                    
                    <div class="playerWrapper">
                        <img src="<?php echo $user->pictureURL;?>" />
                        <div class="name"><?php echo $user->name;?></div>
                        <div class="surname"><?php echo $user->surname;?></div>
                        <div class="rank"><span class="<?php echo $user->getRank(); ?>">&nbsp;<?php echo $user->getRank(); ?>&nbsp;</span></div>
                    </div>

                    <div class="counterWrapper">
                        <div class="counterBorder">
                            <div class="counterCircle">
                                <div class="count" id="counter">4</div>
                            </div>
                        </div>
                        <div class="ribbon">
                            <h1>
                               <strong class="ribbon-content">Game starts in</strong>
                            </h1>
                        </div>
                        
                    </div>

        
        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        
        <script>
            var seconds;
              var temp = document.getElementById('counter');
 
              function countdown() {
                seconds = document.getElementById('counter').innerHTML;
                seconds = parseInt(seconds, 10);
 
                if (seconds == 1) {
                  //temp = document.getElementById('counter');
                  window.location="challenge.php";
                  
                  return;
                }
 
                seconds--;
                //temp = document.getElementById('counter');
                temp.innerHTML = seconds;
                timeoutMyOswego = setTimeout(countdown, 1000);
              } 
 
                countdown();

        </script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>       
        <?php include_once "comp/menu.php"; ?> 
    </body>
</html>