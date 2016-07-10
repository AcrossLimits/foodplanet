<?php
    
    // Start session
    session_start();

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    // Inlcudes
    include('classes/User.php');

     // Create objects
    $user = new User;
    $return = 1;
    
    if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {
        $user = $user->getUser($uid);
        
        if(isset($_GET["bID"])) {
            $badgeID = $_GET["bID"];
            if(isset($_GET["return"])) {
                $return = $_GET["return"];
            }
            $user->updateRank($user->id, $badgeID);
            if($return == 1)
                header("Location: page.php#badges");
            else if($return == 2)
                header("Location: page.php#dashboard");
            else
                header("Location: page.php#badges");
        }

        // If the user has been banned, redirect them
        if($user->statusID == 3) {
            header("Location: banned.php");
        }

    }
    else {
        header("Location: page.php#dashboard");
    }
}

else {
    header("Location: login.php");
}

    
?>
