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
    
    if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {
        $user = $user->getUser($uid, TRUE);
        
        if(isset($_GET["cID"]) && isset($_GET["d"]) && isset($_GET["m"]) && isset($_GET["y"])) {
            $countryID = $_GET["cID"];
            $datestring = $_GET['m'].'/'.$_GET['d'].'/'.$_GET['y'];
            $dob = new DateTime($datestring);
            echo date_format($dob, 'Y-m-d H:i:s');

            $user->updateCountryDOB($user->id, $countryID, $dob);
            header("Location: page.php#dashboard");
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
