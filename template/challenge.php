<?php
session_start();
include_once('classes/User.php');
include_once('classes/Challenge.php');
   
$user = new User;



if ($_SESSION['FBID']) {
    $opponentScore = 0;
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
    // Get the challenge
    $challenge = new Challenge;
    $question = new Question;
    $challenge = $challenge->getChallenge($_SESSION['CHALLENGEID']);
    $currentQuestion = $_SESSION['CHALLENGECURQUESTION'] + 1;
    
    // If we've answered the final question
    if($currentQuestion > $amountQuestions) {
        
        // If this is a versus game
        if($challenge->getChallengeType($uid)=="versus") {
            // End the challenge
            //$challenge->finishChallenge($challenge->id, $uid);

            // Move to scores page
            header("Location: endChallenge.php");

        }
        // Otherwise
        else {
            // Submit the challenge
            //$challenge->submitChallenge($challenge->id, $uid);

            // Move to scores page
            header("Location: endChallenge.php");
        }
    }
    else {
        // Save the current question
        $_SESSION['CHALLENGECURQUESTION'] = $currentQuestion;

        // Otherwise get the current question
        $question = $question->getQuestion($challenge->questionIDs[$currentQuestion-1]);

        // Get 3 random answers
        $randomAnswers = $question->getRandomAnswers($question->answer->id);
        $answers = array($randomAnswers[0],$randomAnswers[1],$randomAnswers[2],$question->answer);
        shuffle($answers);

        // If this is a versus challenge, get the opponents score
        if($challenge->getChallengeType($uid)=="versus") {
            $opponentScore = $challenge->getOpponentScore($challenge->questionIDs[$currentQuestion-1], 1234);
        }
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
        <link rel="stylesheet" href="css/challenge.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    </head>
    <body>
        <script type="text/javascript">
			var images = new Array()
			function preload() {
				for (i = 0; i < preload.arguments.length; i++) {
					images[i] = new Image()
					images[i].src = preload.arguments[i]
				}
			}
			preload(
				"http://fnd.acrosslimits.com/<?php echo $answers[0]->imgURL; ?>",
				"http://fnd.acrosslimits.com/<?php echo $answers[1]->imgURL; ?>",
				"http://fnd.acrosslimits.com/<?php echo $answers[2]->imgURL; ?>",
                "http://fnd.acrosslimits.com/<?php echo $answers[3]->imgURL; ?>",
                "http://fnd.acrosslimits.com/<?php echo $question->imgURL;?>"
			)
	    </script>
        <div id="header">
            <div class="title">Question <?php echo $currentQuestion; ?>/<?php echo count($challenge->questionIDs)?></div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>
        
                    <div class="challengeUpper">
                        <div id="questiontitle" class="title fade-in one">Where on earth is this from?</div>
                    </div>
            
                    <div id="challengeWrapper">
                        <div id="Option1" class="option fade-in two" title="<?php echo $answers[0]->id; ?>">
                            <img id="img1" src="<?php echo $answers[0]->imgURL;?>" />
                            <div id="rib1a" class="ribbon-up"><h1><strong class="ribbon-content"><?php echo $answers[0]->text;?></strong></h1></div>
                            <div id="rib1b" class="ribbon-tail-up"><h1><strong class="ribbon-content">&nbsp;</strong></h1></div>
                            <img id="mark1a" src="img/questions/wrongMark.png" class="mark" />
                            <img id="mark1b" src="img/questions/rightMark.png" class="mark" />
                        </div>
                        <div id="Option2" class="option fade-in two" title="<?php echo $answers[1]->id; ?>">
                            <img id="img2" src="<?php echo $answers[1]->imgURL;?>" />
                            <div id="rib2a" class="ribbon-up"><h1><strong class="ribbon-content"><?php echo $answers[1]->text;?></strong></h1></div>
                            <div id="rib2b" class="ribbon-tail-up"><h1><strong class="ribbon-content">&nbsp;</strong></h1></div>
                            <img id="mark2a" src="img/questions/wrongMark.png" class="mark" />
                            <img id="mark2b" src="img/questions/rightMark.png" class="mark" />
                        </div>
                        <div id="Option3" class="option fade-in two" title="<?php echo $answers[2]->id; ?>">
                            <img id="img3" src="<?php echo $answers[2]->imgURL;?>" />
                            <div id="rib3a" class="ribbon-down"><h1><strong class="ribbon-content"><?php echo $answers[2]->text;?></strong></h1></div>
                            <div id="rib3b" class="ribbon-tail-down"><h1><strong class="ribbon-content">&nbsp;</strong></h1></div>
                            <img id="mark3a" src="img/questions/wrongMark.png" class="mark" />
                            <img id="mark3b" src="img/questions/rightMark.png" class="mark" />
                        </div>
                        <div id="Option4" class="option fade-in two" title="<?php echo $answers[3]->id; ?>">
                            <img id="img4" src="<?php echo $answers[3]->imgURL;?>" />
                            <div id="rib4a" class="ribbon-down"><h1><strong class="ribbon-content"><?php echo $answers[3]->text;?></strong></h1></div>
                            <div id="rib4b" class="ribbon-tail-down"><h1><strong class="ribbon-content">&nbsp;</strong></h1></div>
                            <img id="mark4a" src="img/questions/wrongMark.png" class="mark" />
                            <img id="mark4b" src="img/questions/rightMark.png" class="mark" />
                        </div>
                        <div id="Question" class="question fade-in one">
                            <img src="<?php echo $question->imgURL;?>" />
                        </div>
                        <div id="QuestionWrong" class="question">
                            <img src="img/questions/wrong.png" />
                            
                        </div>
                        <div id="QuestionRight" class="question">
                            <img src="img/questions/right.png" />
                        </div>
                        <div id="afterRight" class="afterQuestion">
                            <div class="upper">YES!!!</div>
                            <div class="middle">Right answer</div>
                            <div class="lower">Tap to<br/>move on!</div>
                        </div>
                        <div id="afterWrong" class="afterQuestion">
                            <div class="upper">OUCH!!!!</div>
                            <div class="middle">Wrong answer</div>
                            <div class="lower">Tap to<br/>move on!</div>
                        </div>
                        <div id="afterTime" class="afterQuestion">
                            <div class="upper">OUCH!!!!</div>
                            <div class="middle">Out of time</div>
                            <div class="lower">Tap to<br/>move on!</div>
                        </div>
                    </div>
                    <script>
                        document.getElementById('challengeWrapper').style.height = document.getElementById('challengeWrapper').clientWidth + 'px';
                        document.getElementById('Option1').style.height = document.getElementById('Option1').clientWidth + 'px';
                        document.getElementById('Option2').style.height = document.getElementById('Option2').clientWidth + 'px';
                        document.getElementById('Option3').style.height = document.getElementById('Option3').clientWidth + 'px';
                        document.getElementById('Option4').style.height = document.getElementById('Option4').clientWidth + 'px';
                        document.getElementById('Question').style.height = document.getElementById('Question').clientWidth + 'px';

                        var question = document.getElementById('Question');
                        if (question.clientHeight > question.clientWidth) {
                            question.style.width = question.clientHeight + 'px';
                        }

                        if (question.clientWidth > question.clientHeight) {
                            question.style.height = question.clientWidth + 'px';
                        }
                    </script>

                
            
            

        
        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>



        
        
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <div id="challengeLower" class="challengeLower fade-in two">
           <div id="progress">
                <span id="percent"><div id="progressValue">100 Points</div></span>
               <div id="barbg"></div>
               <div id="opponentBar"></div>
               <div id="bar"></div>  
            </div>
            <div id="moreinfo" style="display: none;">
                <div class="infoWrapper"><div id="whatis">What is <b><?php echo $question->title; ?></b>?</div></div>
            </div>
                        
        </div>
        <div id="opponentAnswered">
            <p id="opponentAnsweredText" class="pause">Opponent Answered</p>
        </div>
        <script type="text/javascript">

            
            var seconds = 100;
            var temp;
            var bar;
            var opponentAnswered = false;
            var opponentScore = <?php echo $opponentScore; ?>;
            var pause = false;

            function reset() {
                seconds = 100;
                opponentAnswered = false;
                temp = document.getElementById('progressValue');

                document.getElementById('bar').style.width = seconds + "%";
                document.getElementById('opponentBar').style.width = seconds + "%";
                document.getElementById('opponentAnsweredText').className = "pause";
                temp.innerHTML = seconds + " Points";
            }

            var countdownBar = document.getElementById('bar');
            var opponentBar = document.getElementById('opponentBar');
            var temp = document.getElementById('progressValue');

            function countdown() {


                if (seconds == 0) {
                    //temp = document.getElementById('counter');
                    //window.location="dashboard.php";
                    TimeUp();
                    pause = true;
                }

                if (seconds == opponentScore && opponentScore > 0) {
                    document.getElementById('opponentAnsweredText').className = "play";
                    navigator.vibrate(100);
                    opponentAnswered = true;
                }

                if (!pause && window.getComputedStyle(document.getElementById('challengeLower')).opacity > 0.95) {
                    seconds--;

                    countdownBar.style.width = seconds + "%";
                    if (!opponentAnswered) {
                        opponentBar.style.width = seconds + "%";
                    }

                    temp.innerHTML = seconds + " Points";

                }

                timeoutMyOswego = setTimeout(countdown, 120);
            }

            countdown();

        </script>

        <?php // Button Press Answer ?>
        <script type="text/javascript">
            
            var goto = "";
            var option1 = document.getElementById('Option1');
            var option2 = document.getElementById('Option2');
            var option3 = document.getElementById('Option3');
            var option4 = document.getElementById('Option4');
            var questionRight = document.getElementById('afterRight');
            var questionWrong = document.getElementById('afterWrong');
            var questionTime = document.getElementById('afterTime');
            var whatis = document.getElementById('whatis');


            option1.onclick = function() {ClickOption(this.title)};
            option2.onclick = function() {ClickOption(this.title)};
            option3.onclick = function() {ClickOption(this.title)};
            option4.onclick = function() {ClickOption(this.title)};
            questionRight.onclick = function() {ClickQuestion()};
            questionWrong.onclick = function() {ClickQuestion()};
            questionTime.onclick = function() {ClickQuestion()};
            whatis.onclick = function() {Clickwhatis()};

            function ClickOption(id) {
                pause = true;
                document.getElementById('Question').style.display = "none";
                document.getElementById('questiontitle').innerHTML = "<?php echo $question->title; ?>";
                
                // If it's the correct answer
                if(id == <?php echo $question->answer->id; ?>) {
                    document.getElementById('QuestionWrong').style.display = "none";
                    document.getElementById('QuestionRight').style.display = "block";
                    document.getElementById('afterRight').style.display = "block";
                    document.getElementById('moreinfo').style.display = "block";
                    document.getElementById('progress').style.display = "none";
                    Vibrate(100);
                    goto = "answerQuestion.php?score="+seconds;
                }

                // If it's the wrong answer
                else {
                    document.getElementById('QuestionRight').style.display = "none";
                    document.getElementById('QuestionWrong').style.display = "block";
                    document.getElementById('afterWrong').style.display = "block";
                    document.getElementById('moreinfo').style.display = "block";
                    document.getElementById('progress').style.display = "none";
                    Vibrate(500);
                    goto = "answerQuestion.php?score=0";
                }

                // Disable onClick Events
                option1.style.pointerEvents = 'none';  
                option2.style.pointerEvents = 'none';
                option3.style.pointerEvents = 'none';
                option4.style.pointerEvents = 'none';

                option1.onclick = null;
                option2.onclick = null;
                option3.onclick = null;
                option4.onclick = null;

                // Display the Check or X marks on the answers
                if(option1.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark1b').style.display = "block";
                }  
                else {
                    document.getElementById('img1').style.opacity = "0.3";
                    document.getElementById('rib1a').style.opacity = "0.3";
                    document.getElementById('rib1b').style.opacity = "0.0";
                    document.getElementById('mark1a').style.display = "block";
                }
                if(option2.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark2b').style.display = "block";
                }  
                else {
                    document.getElementById('img2').style.opacity = "0.3";
                    document.getElementById('rib2a').style.opacity = "0.3";
                    document.getElementById('rib2b').style.opacity = "0.0";
                    document.getElementById('mark2a').style.display = "block";
                }
                if(option3.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark3b').style.display = "block";
                }  
                else {
                    document.getElementById('img3').style.opacity = "0.3";
                    document.getElementById('rib3a').style.opacity = "0.3";
                    document.getElementById('rib3b').style.opacity = "0.0";
                    document.getElementById('mark3a').style.display = "block";
                }
                if(option4.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark4b').style.display = "block";
                }  
                else {
                    document.getElementById('img4').style.opacity = "0.3";
                    document.getElementById('rib4a').style.opacity = "0.3";
                    document.getElementById('rib4b').style.opacity = "0.0";
                    document.getElementById('mark4a').style.display = "block";
                }
            };

            function ClickQuestion() {                
                window.location=goto;                
                Vibrate(100); 
            };

            function Clickwhatis() {
                window.location = goto+"&learn=1";
            };

            
            function TimeUp() {
                goto = "answerQuestion.php?score=0";
                document.getElementById('Question').style.display = "none";
                document.getElementById('QuestionRight').style.display = "none";
                document.getElementById('QuestionWrong').style.display = "block";
                document.getElementById('afterTime').style.display = "block";
                document.getElementById('moreinfo').style.display = "block";
                document.getElementById('progress').style.display = "none";
                document.getElementById('questiontitle').innerHTML = "<?php echo $question->title; ?>";

            // Display the Check or X marks on the answers
                if(option1.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark1b').style.display = "block";
                }  
                else {
                    document.getElementById('img1').style.opacity = "0.3";
                    document.getElementById('rib1a').style.opacity = "0.3";
                    document.getElementById('rib1b').style.opacity = "0.0";
                    document.getElementById('mark1a').style.display = "block";
                }
                if(option2.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark2b').style.display = "block";
                }  
                else {
                    document.getElementById('img2').style.opacity = "0.3";
                    document.getElementById('rib2a').style.opacity = "0.3";
                    document.getElementById('rib2b').style.opacity = "0.0";
                    document.getElementById('mark2a').style.display = "block";
                }
                if(option3.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark3b').style.display = "block";
                }  
                else {
                    document.getElementById('img3').style.opacity = "0.3";
                    document.getElementById('rib3a').style.opacity = "0.3";
                    document.getElementById('rib3b').style.opacity = "0.0";
                    document.getElementById('mark3a').style.display = "block";
                }
                if(option4.title == <?php echo $question->answer->id; ?>) { 
                    document.getElementById('mark4b').style.display = "block";
                }  
                else {
                    document.getElementById('img4').style.opacity = "0.3";
                    document.getElementById('rib4a').style.opacity = "0.3";
                    document.getElementById('rib4b').style.opacity = "0.0";
                    document.getElementById('mark4a').style.display = "block";
                }

                
            };

            function Vibrate(duration) {
                // enable vibration support
                navigator.vibrate = navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate;
 
                if (navigator.vibrate) {
                    // vibration API supported
                    navigator.vibrate(duration);
                }
            };
            

        </script>
        <?php //include_once "comp/menu.php"; ?>
    </body>
</html>