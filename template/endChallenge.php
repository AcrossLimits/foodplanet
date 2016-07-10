<?php
session_start();


include('classes/User.php');
include('classes/Challenge.php');
include('classes/BadgeManager.php');
   
$user = new User;
$badgeManager = new BadgeManager;

if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {
    $user = $user->getUser($uid);

    // If the user has been banned, redirect them
    if($user->statusID == 3) {
        header("Location: banned.php");
    }

    // Store the users current points
    $oldPoints = $user->getPoints($user->id);
    }
    else
    $user->createGuest();
    // Get the user's score
    $score = 0;
    $opponent = new User;
    $opponentScore = 0;

    $challenge = new Challenge;
    //$challenge = $challenge->getChallenge(133);

    $challengeType = 1; // 1 - New, 2 - Win, 3 - Loss, 4 - draw

    $challenge = $challenge->getChallenge($_SESSION['CHALLENGEID']);

    // First find if this is a new submission or if the challenge has been completed

    // If this is a versus game
    if($challenge->getChallengeType($uid)=="versus") {
        // End the challenge
        $challenge->endChallenge($challenge->id, $uid);

        // Get the user's score
        $score = $challenge->getChallengeScore($challenge->id, $uid);

        // Get the opponent and their score
        $opponent = $challenge->getChallengeOpponent($challenge->id, $uid);
        $opponentScore = $challenge->getChallengeScore($challenge->id, $opponent->id);

        if($uid != 'Guest') {
            $badgeManager->Validate($opponent->id, 0);
        }
        // Change page depending on winner
        if($score > $opponentScore) {
            $challengeType = 2;
        }
        else if($score < $opponentScore) {
            $challengeType = 3;
        }
        else {
            $challengeType = 4;
        }

    }

    // If this is a new game
    else {
        $challengeType = 1;

        // Submit the challenge
        $challenge->submitChallenge($challenge->id, $uid);

        // Get the user's score
        $score = $challenge->getChallengeScore($challenge->id, $uid);
    }

    $badgeManager->Validate($uid, 0);

    if($challengeType == 0)
        header("Location: page.php#dashboard");

    $obtainedBadges = array();
    $obtainedBadges = $badgeManager->GetAllUnseen($uid);
    foreach($obtainedBadges as $badge) {
        $badge->MarkAsSeen($badge->id, $uid);
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
        <link rel="stylesheet" href="css/endChallenge.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    </head>
    <body>
        <div id="header">
            <div class="title">Challenge Mode</div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>
                    <div id="challengeUpper">
                        <div class="title fade-in one"><?php
                            if($challengeType == 1)
                                echo "Challenge Sent";
                            else if($challengeType == 2)
                                echo "You Won!";
                            else if ($challengeType == 3)
                                echo "You Lost!";
                            else
                                echo "It's a Tie!"
                        ?></div>
                    </div>
                    <table id="challengeParticipants" class="fade-in two">
                        <tr>
                            <td>
                                <div class="playerPhoto" <?php if($challengeType == 1) echo "style='width: 20%;'";?>><img src="<?php echo $user->pictureURL; ?>" alt="" /></div>
                                <div class="scoreTitle">Score</div>
                                <div class="scoreValue"><?php echo $score;?></div>
                            </td>
                            <?php if($challengeType > 1) {?>
                            <td>
                                <div class="playerPhoto"><img src="<?php echo $opponent->pictureURL; ?>" alt="" /></div>
                                <div class="scoreTitle">Score</div>
                                <div class="scoreValue"><?php echo $opponentScore;?></div>
                            </td>    
                            <?php } ?>
                        </tr>
                    </table>
                    <?php if($uid != 'Guest') {?>
                        <div id="award" class="fade-in three">
                            <div class="title">Your Points</div>
                            <div class="value" id="value"><?php echo $oldPoints;?></div>
                        </div>
                    <?php }?>
             
            
        <div id="challengeLower" class="fade-in four">
            <div class="text">Return home</div>
        </div>
        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <?php include_once "components/dialogs/dialogBadgeUnlocked.php"; ?>
        
         <script>
            var returnHome = document.getElementById("challengeLower");
            returnHome.onclick = function () { ReturnHome() };

            function ReturnHome() {
                window.location = "page.php#dashboard";
            };
        </script>
        <script>
            <?php if($uid != 'Guest') {?>
            $("#award")
            .on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
             function(e){
                // Animate the element's value from x to y:
          $({someValue: <?php echo $oldPoints;?>}).animate({someValue: <?php echo $oldPoints+$score;?>}, {
              duration: 1400,
              easing:'swing', // can be anything
              step: function() { // called on every step
                  // Update the element's text with rounded-up value:
                  $('#value').text(commaSeparateNumber(Math.round(this.someValue)));
              },
              complete:function(){
                  $('#value').text(commaSeparateNumber(Math.round(this.someValue)));
              }
          });
                $(this).off(e);
             });
            

         function commaSeparateNumber(val){
            //while (/(\d+)(\d{3})/.test(val.toString())){
              //val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ");
            //}
            return val;
          }
            <? }?>

        </script>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>     
        <script type="text/javascript">
            <?php if($uid != 'Guest') {?>
        // Handle Badges
        <?php foreach ($obtainedBadges as $badge) { ?>
            addBadgeToQueue("<?php echo $badge->name; ?>", "<?php echo $badge->description; ?>", <?php echo $badge->id; ?>, "<?php echo $badge->borderColor; ?>", "<?php echo $badge->bgColor; ?>");
        <?php } ?>
        
        <?php if(sizeof($obtainedBadges)>0) {?>
            displayBadgeDialog();
        <?php } }?>

    </script>
           
    </body>
</html>