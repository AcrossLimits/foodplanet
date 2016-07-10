<?php
     session_start();
     $_SESSION['FBID'] = 'Guest';
     header("Location: page.php#dashboard");
?>
