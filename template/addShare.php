<?php
    include('classes/User.php');
    $user = new User;
    if(isset($_GET['userID'])) {
        $UID = $_GET['userID'];
        $user = $user->getUser($UID);
        $user->saveShares($UID, 1);
        echo "true";
    }
    else
        echo "false";
?>