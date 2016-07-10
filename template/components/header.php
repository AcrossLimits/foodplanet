<?php
    // Start session
    session_start();

    // Inlcudes
    include('classes/User.php');
    include('classes/Badge.php');
    include_once('classes/BadgeManager.php');  
    include('classes/Leaderboard.php');
    include_once('classes/LeaderboardItem.php');
    include('classes/Catalog.php');
    include_once('classes/CatalogItem.php');
    include_once('classes/DBConnection.php');     

    // Create objects
    $user = new User;
    $badge = new Badge;
    $badgeManager = new BadgeManager;
    $leaderboard = new Leaderboard;
    $catalog = new Catalog;
    

    // TEMPORARY
    $uid = 1;
    $type = 1;


    
    if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {
        $user = $user->getUser($uid);

        // If the user has been banned, redirect them
        if($user->statusID == 3) {
            header("Location: banned.php");
        }



        $badgeManager->Validate($uid, 0);

        $obtainedBadges = array();
        $obtainedBadges = $badgeManager->GetAllUnseen($uid);
        foreach($obtainedBadges as $badge) {
            $badge->MarkAsSeen($badge->id, $uid);
        }

        // Badges
        $geo_badges = $badge->getAllBadges(1);
        $challenge_badges = $badge->getAllBadges(3);
        $upload_badges = $badge->getAllBadges(2);
        $count = 0;
        $total = 0;
        $BADGES_PER_ROW = 3;
        $specialOpen = TRUE;
        $userBadges = array();
        $userBadges = $badgeManager->GetAllObtained($uid);

        // Catalog
        $catalog_AZ = $catalog->getCatalogAZ($uid);
        $catalog_country = $catalog->getCatalogCountry($uid);
    }
    else {
        $user->createGuest();
        $catalog_AZ = $catalog->getCatalogAZFromSession($uid);
        $catalog_country = $catalog->getCatalogCountryFromSession($uid);
    }

     // Leaderboards
    $amountPlayers = 500;
    $leaders_pointsweek = $leaderboard->getTopPointsWeek($amountPlayers);
    $leaders_pointsalltime = $leaderboard->getTopPointsAllTime($amountPlayers);
    $leaders_challengesweek = $leaderboard->getTopWinsWeek($amountPlayers);
    $leaders_challengesalltime = $leaderboard->getTopWinsAllTime($amountPlayers);
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
        <link rel="stylesheet" href="css/dialog.css">
    </head>
    <body>
        <?php
        // Google Tracking
        include_once('components/js_googleanalytics.php');
        ?>
        <div id="fb-root"></div>
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
				FB.ui({
				  method: 'share',
				  href: 'https://www.facebook.com/foodplanetgame',
				  mobile_iframe: true
				}, function(response){});
			}

			var shareImage = "";
			var shareTitle = "";
			var shareDescription = "";
        </script>

        <table id="header">
            <tr>
            <td id="homeIcon"><a href="#dashboard" id="homeIcon_Icon"><img src="img/icon_home_white.png" /></a></td>
            <td id="pageTitle">Food Planet</td>
            <td id="menuButton"><img src="img/icon_menu_white.png" /></td>            
            </tr>
        </table>