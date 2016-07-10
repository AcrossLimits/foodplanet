<?php 


    // Gather countries
    global $connection;
    include_once('classes/DBConnection.php');

    $wins = 0;

    if ($_SESSION['FBID']) {
    
        $uid = $_SESSION['FBID'];
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);
        $query = "SELECT COUNT(seen) as seen FROM tblChallengeWins WHERE winnerID = '$uid' AND seen = 0";
        $result = mysqli_query($connection, $query);

        if ($result=="null") {
	    }
        else {
            $fullData = array();
	        $row = $result->fetch_assoc();
                        
                // Get basic question info
                $wins = $row['seen'];                    
                              
        }

        if($wins > 0) {
           // Set challengewins to seen
           $query2 = "UPDATE tblChallengeWins SET seen=1 WHERE winnerID = '$uid' AND seen = 0";
           $result2 = mysqli_query($connection, $query2); 

        }



    }

    else {
        header("Location: login.php");
    } 



?>

<div id="dialogAwayWins">
    <div class="blackout"></div>
    <div class="wrapper" id="dialogWrapper">
        <table>
            <tr>
                <td class="icon"><img src="img/icons/iconLeaderboard.jpg" alt=""/></td>
                <td><p>You've won <span><?php echo $wins; ?></span> of the challenges you created!</p></td>
            </tr>
        </table>
        <div class="dismiss">Dismiss</div>
    </div>
</div>

<script>
    var dialogAwayWins = document.getElementById("dialogAwayWins");
    var dialogWrapper = document.getElementById("dialogWrapper");

    var wins = <?php echo $wins; ?>;
    if(wins > 0) {
        dialogAwayWins.style.display = "block";
    }
    else {
        dialogAwayWins.style.display = "none";
    }


    dialogWrapper.onclick = function() {dialogAwayWins.style.display = "none";};
</script>