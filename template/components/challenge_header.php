<?php
    // Start session
    session_start();

    // Inlcudes
    include('classes/User.php');
    include_once('classes/Challenge.php');

    // Create objects
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
    $opponent = new User;
    $createID = 0;

    // Try and find an active challenge
    $challenge = $challenge->getActiveChallenge($user->id);
    // If found, accept the challenge
    if($challenge->id != NULL) {
        $challenge->acceptChallenge($challenge->id, $user->id);
        $opponent = $challenge->getChallengeOpponent($challenge->id, $user->id);

        
    }

    // Otherwise 
    else {
         // If the user isnt a Guest, create a challenge
         //if($uid != 'Guest') {
            // Create a challenge and get the id number of it
            $createID = $challenge->createChallenge($user->id, $amountQuestions);
            $challenge = $challenge->getChallenge($createID);
         //}

         // Otherwise return to dashboard
         //else {
             //header("Location: page.php#dashboard");
         //}
        //header("Location: createChallenge.php");
    }

    if(!isset($_SESSION["questionIDString"])) {
        $_SESSION["questionIDString"] = "";
    }

    

}

else {
    header("Location: login.php");
}

    

   
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="AcrossLimits">
        <title>Food Planet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/challenge_style.css">
        <link rel="stylesheet" href="css/dialog.css">
    </head>
    <body>
        <?php
            // Google Tracking
            include_once('components/js_googleanalytics.php');
        ?>
       <script>
           window.fbAsyncInit = function () {
               FB.init({
                   appId: '1471382046511077',
                   xfbml: true,
                   version: 'v2.4'
               });
           };

           (function (d, debug) { var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0]; if (d.getElementById(id)) { return; } js = d.createElement('script'); js.id = id; js.async = true; js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js"; ref.parentNode.insertBefore(js, ref); } (document, /*debug*/false));

           function postToFeed(title, desc, url, image) {
				//var obj = { method: 'feed', link: url, picture: image, name: title, description: desc };
				//function callback(response) { }
				//FB.ui(obj, callback);
			}

			function facebookShare(desc) {
				"use strict";
                $.ajax({
                    type:"GET", 
                    url: "https://fnd.acrosslimits.com/addShare.php",
                    data: "userID="+<?php echo $uid;?>, 
                    success: function(data) {
                    }, 
                    error: function(jqXHR, textStatus, errorThrown) {
                    //console.log("Unable to get item information");
                }});
				FB.ui({
				  method: 'share',
				  href: 'https://www.facebook.com/foodplanetgame',
				  mobile_iframe: true
				}, function(response){});
			}

           if (sessionStorage.getItem("questionIDString") == null) {
               console.log("Not found");
               sessionStorage.setItem("questionIDString", "");
           }

        </script>

        <table id="header">
            <tr>            
            <td id="pageTitle">Food Planet</td>
                    
            </tr>
        </table>