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
        <link rel="stylesheet" href="css/uploadThanks.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        
         <div id="header">
            <div class="title">Upload Succeded</div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>
                    <div id="pageWrapper">
                        <div id="uploadImage"><img src="img/imgUploadThanks.png" class="fade-in one"/></div>
                        <div class="upper fade-in two">Thanks for uploading!</div>
                        <div class="middle fade-in two">Your content has been submitted for review</div>
                    </div>
                
        <div id="uploadLower" class="fade-in three">
            <div class="text">Return home</div>
        </div>
          
        <?php include_once "comp/menu.php"; ?>
        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>     
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>     
        <script>
            var returnHome = document.getElementById("uploadLower");
            returnHome.onclick = function () { ReturnHome() };

            function ReturnHome() {
                window.location = "dashboard.php";
            };
        </script>
        
        
    </body>
</html>