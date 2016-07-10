<?php 
    global $connection;
    include_once('classes/DBConnection.php');

    if ($_SESSION['FBID']) {
    
        $uid = $_SESSION['FBID'];
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);

    }

    else {
        header("Location: login.php");
    } 



?>

<div id="dialogBadge">
    <div class="blackout"></div>
    <div class="wrapper" id="dialogBadgeWrapper">
        <div class="title">Badge Unlocked!</div>
        <table>
            <tr>
                <td class="icon"><img src="img/icons/iconLeaderboard.jpg" alt=""/></td>
                <td>
                    <div class="badgeName">Badge Name</div>
                    <div class="badgeDescription">Do what's written over here to unlock this badge.</div>
                </td>
            </tr>
        </table>
        <div class="dismiss">Dismiss</div>
    </div>
</div>

<script>
    var dialogBadgeMain = document.getElementById("dialogBadge");
    var dialogBadgeWrapper = document.getElementById("dialogBadgeWrapper");
    /*
    var wins = <?php echo $wins; ?>;
    if(wins > 0) {
        dialogBadgeMain.style.display = "block";
    }
    else {
        dialogBadgeMain.style.display = "none";
    }
    */

    dialogBadgeWrapper.onclick = function() {dialogBadgeMain.style.display = "none";};
</script>