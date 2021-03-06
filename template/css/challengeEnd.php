<?php
    // Start session
    session_start();
    
    // Inlcudes
    include('classes/User.php');
    include('classes/Badge.php');
    include_once('classes/BadgeManager.php');  
    include_once('classes/Challenge.php');

    // Create objects
    $user = new User;
    $badge = new Badge;
    $badgeManager = new BadgeManager;
    $oldPoints = 0;
    if ($_SESSION['FBID']) {
        $uid = $_SESSION['FBID'];
        if($uid != 'Guest') {
            $user = $user->getUser($uid);
            $oldPoints = $user->getPoints($user->id);
            // If the user has been banned, redirect them
            if($user->statusID == 3) {
                header("Location: banned.php");
            }
            $shares = $_GET['sh'];
            $_SESSION["shareCount"] = 0;
            $user->saveShares($uid, $shares);
            $badgeManager->Validate($uid, 0);

            $obtainedBadges = array();
            $obtainedBadges = $badgeManager->GetAllUnseen($uid);
            foreach($obtainedBadges as $badge) {
                $badge->MarkAsSeen($badge->id, $uid);
            }
        }
        else {
            $user->createGuest();
        }

        $challenge = new Challenge;
        $opponent = new User;
        $opponentScore = 0;
        $score = $_GET['ts'];

        $challengeType = 1; // 1 - New, 2 - Win, 3 - Loss, 4 - draw
        $challenge = $challenge->getChallenge($_GET['cid']);

        // If this is a versus game
        if($challenge->getChallengeType($uid)=="versus") {
            // End the challenge
            $challenge->endChallenge($challenge->id, $uid);

            // Submit the scores of each individual question
            $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[0], intval($_GET['s1']));
            $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[1], intval($_GET['s2']));
            $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[2], intval($_GET['s3']));
            $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[3], intval($_GET['s4']));
            $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[4], intval($_GET['s5']));

            // Get the opponent and their score
            $opponent = $challenge->getChallengeOpponent($challenge->id, $uid);
            $opponentScore = $challenge->getChallengeScore($challenge->id, $opponent->id);

            $challenge->submitScore($challenge->id, $uid, $score);

            // If the user isnt a guest, submit any shares and then validate their badges
            if($uid != 'Guest') {
                $badgeManager->Validate($opponent->id, 0);
            }

            // Change page depending on winner
            if($score > $opponentScore) {
                $challengeType = 2;
                $challenge->addChallengeWinner($challenge->id, $uid, 1);
            }
            else if($score < $opponentScore) {
                $challengeType = 3;
                $challenge->addChallengeWinner($challenge->id, $opponent->id, 0);
            }
            else {
                $challengeType = 4;
                $challenge->addChallengeWinner($challenge->id, 'draw', 0);
            }
        }

        // If this is a new game
        else {
            $challengeType = 1;
            if($uid != 'Guest') {
                // Submit the challenge
                $challenge->submitChallenge($challenge->id, $uid);

                // Submit the scores of each individual question
                $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[0], intval($_GET['s1']));
                $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[1], intval($_GET['s2']));
                $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[2], intval($_GET['s3']));
                $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[3], intval($_GET['s4']));
                $challenge->answerQuestion($challenge->id, $uid, $challenge->questionIDs[4], intval($_GET['s5']));


                $challenge->submitScore($challenge->id, $uid, $score);
            }
        }
    }
    else {
        header("Location: login.php");
    }

    if($opponent->id != NULL)
        $totalPlayers = 2;
    else {
        $totalPlayers = 1;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="AcrossLimits">
        <title>Europeana Food & Drink</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/challenge_style.css">
        <link rel="stylesheet" href="css/dialog.css">
    </head>
    <body>
 
        <?php
            // Google Tracking
            include_once('components/js_googleanalytics.php');
            echo "<script>";
            if($totalPlayers == 1)
                echo "ga('send', 'event', 'button', 'challenge', 'Challenges Created');";
            else if($totalPlayers == 2)
                echo "ga('send', 'event', 'button', 'challenge', 'Challenges Played');";
            else {}
            echo "</script>";
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
                var obj = { method: 'feed', link: url, picture: image, name: title, description: desc };
                function callback(response) { }
                FB.ui(obj, callback);
            }

            var shareImage = "";
            var shareTitle = "";
            var shareDescription = "";
        </script>

        <table id="header">
            <tr>            
            <td id="pageTitle"data-localize='_challenge._end'>Challenge Over</td>
                    
            </tr>
        </table>
        <div id="challenge_end" class="page" data="#bbe5fa" name="End Challenge">
    <div id="challengeEndUpper">
        <?php if ($totalPlayers > 1) {?>
        <div id="credits">
        <?php
            if($score > $opponentScore)
                echo "<span  data-localize='_challenge._win'>You Win!</span>";
            else if($score < $opponentScore)
                echo "<span  data-localize='_challenge._lose'>You Lose!</span>";
            else
                echo "<span  data-localize='_challenge._tie'>It's a tie!</span>";
                   
        ?>
        </div>
        <?php }?>
        <table class="challengePlayersWrapper">
            <tr>
                <td>
                    <div class="playerWrapper" id="player1Wrapper">
                        <div class="playerPhoto"><img src="<?php echo $user->pictureURL;?>"  class="playerChallengePhoto"/></div>

                    </div>
                    <div class="playerName"><?php echo $user->name." ".$user->surname;?></div>
                    <?php if($uid!="Guest") {?>
                    <div class="playerCountry"><img src="<?php echo $user->getFlagURL();?>" /><?php echo $user->country;?></div>
                    <?php }else {?>
                    <div class="playerCountry">-<?php echo $user->country;?></div>
                    <?php }?>
                    <div class="playerRank <?php echo $user->getRank();?>"><?php echo $user->getRank();?></div>
                    <div class="playerScore">
                        <div class="title">Score</div>
                        <div class="value"><?php echo $score; ?></div>
                    </div>
                </td>
                
                <?php if($totalPlayers == 2) {?>      
                <td id="challengeEndUpperSpacer">
                    <div></div>
                </td>      
                <td>
                    <div class="playerWrapper" id="player2Wrapper">
                        <div class="playerPhoto"><img src="<?php echo $opponent->pictureURL;?>"  class="playerChallengePhoto"/></div>
                    </div>
                    <div class="playerName"><?php echo $opponent->name." ".$opponent->surname;?></div>
                    <div class="playerCountry"><img src="<?php echo $opponent->getFlagURL();?>" /><?php echo $opponent->country;?></div>
                    <div class="playerRank <?php echo $opponent->getRank();?>"><?php echo $opponent->getRank();?></div>
                    <div class="playerScore">
                        <div class="title">Score</div>
                        <div class="value"><?php echo $opponentScore; ?></div>
                    </div>
                </td>
                <?php }?>
                
            </tr>
            <?php if($totalPlayers==2 && $score > $opponentScore && $uid != 'Guest'){ ?>
            <tr>
                <td colspan="3">
                    <a href="http://bit.ly/FoodPlanetGame" data-image="http://fnd.acrosslimits.com/img/facebookWinner.png" data-title="I beat XXX in Food Planet!" data-desc="I just beat XXX in Food Planet with a score of YYY! How will you do?" class="fb_share"  id="dialogBadgeShare">
                        <div class="badgeShare" data-localize="_badges._share">Share Your Victory</div>      
                    </a>  
                </td>
            </tr>
            <?php }?>
        </table>
        
    </div>

    <div id="challengeEndMiddle">
        <?php if($uid != 'Guest') {?>
        <!--<div class="scoreCounter" id="award">
            <div class="title"  data-localize="_challenge._points">Your Points</div>
            <div class="value" id="pointsValue"><?php echo $oldPoints+$score;?></div>
        </div>-->
        <?php }?>

        <div id="challengeItems">
            <div class="title"><p>Challenge Items</p></div>
        </div>

    </div>

    <div id="challengeEndLower"  data-localize="_upload._return">
            Return Home
    </div>

</div>

         <script src="//code.jquery.com/jquery-1.10.2.min.js"></script> 
         <script src="js/jquery.localize.js"></script>
    <script>
            $("[data-localize]").localize("lang/lang", { skipLanguage: ["en", "en-US"], language: "<?php echo $user->lang;?>"});
        </script>
        <?php include_once "components/dialogs/dialogBadgeUnlocked.php"; ?> 
    <script type="text/javascript">
        // Main page features
        var challenge_end = document.getElementById("challenge_end");
        var page_title = document.getElementById("pageTitle");
        var page_content = document.getElementById("pageContent");
        var header = document.getElementById("header");
        var current = challenge_end;
        var challengeEndLower = document.getElementById("challengeEndLower");
        document.body.style.backgroundColor = '' + current.getAttribute("data");
        page_title.innerHTML = '' + current.getAttribute("name");
        challenge_end.style.top = (header.clientHeight) + 'px';
        challenge_end.style.height = (window.innerHeight - header.clientHeight) + 'px';
        sessionStorage.shareCount = 0;
        challengeEndLower.onclick = function () {
            window.location = "page.php#dashboard";
        };
    </script>
        <script>
            var size = $('.playerPhoto').css('padding-bottom');
                $('.playerChallengePhoto').height(size);
                $('.playerChallengePhoto').width(size);
        </script>
        <script type="text/javascript">
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
                          $('#pointsValue').text(commaSeparateNumber(Math.round(this.someValue)));
                      },
                      complete:function(){
                          $('#pointsValue').text(commaSeparateNumber(Math.round(this.someValue)));
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
        <?php if($totalPlayers==2 && $score > $opponentScore && $uid != 'Guest'){ ?>
            <script type="text/javascript">
                var shareButton;
                shareImage = "http://fnd.acrosslimits.com/img/facebookWinner.png";
                shareTitle = "I beat <?php echo $opponent->name; ?> in Food Planet!";
                shareDescription = "I just beat <?php echo $opponent->name; ?> in Food Planet with a score of <?php echo $score; ?>! How will you do?";

                var fbShareBtn = document.querySelector('.fb_share');
                fbShareBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    var title = shareTitle,
                            desc = shareDescription,
                            url = fbShareBtn.getAttribute('href'),
                            image = shareImage;
                    postToFeed(title, desc, url, image);

                    return false;
                });

            </script>
            <?php }?>
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
            
     
    <script src="js/fontScaler.js"></script> 
    <?php
         
        // Google Tracking
        //include_once('components/js_googleanalytics.php')


    ?>
</body>
</html>