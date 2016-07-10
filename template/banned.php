<?php
session_start();

include('classes/User.php');
$user = new User;


if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    $user = $user->getUser($uid);

    if($user->statusID != 3) {
        header("Location: dashboard.php");
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
        <link rel="stylesheet" href="css/banned.css">       
    </head>
    <body>
        
        <div class="bannedWrapper">
            <div id="text" class="text">Your account has been banned</div>
        </div>
   
        <script src="js/fontScaler.js"></script>   
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>      
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        
    </body>
</html>