<?php
session_start();


include('classes/User.php');
include_once('classes/Question.php');

$user = new User;
$question = new Question;



if ($_SESSION['FBID']) {
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
    $question = $question->getQuestion(intval($_GET['qid']));
    $option = intval($_GET['option']);   
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
        <link rel="stylesheet" href="css/learnMore.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <div id="header">
            <div class="title"><?php echo $question->title; ?></div>
            <div class="button" id="menuButton">&nbsp;</div>
        </div>

                    <div id="questionImage"><img src="<?php echo $question->imgURL; ?>" /></div>
                    <table class="learnMenu" id="learnMenu">
                        <tr>
                            <td class="<?php if($option == 1) echo "selected"; ?>"><a href="learnMore.php?qid=<?php echo intval($_GET['qid']); ?>&option=1">Description</a></td>
                            <td class="<?php if($option == 2) echo "selected"; ?>"><a href="learnMore.php?qid=<?php echo intval($_GET['qid']); ?>&option=2">Ingredients</a></td>
                        </tr>
                    </table>
                    <div id="questionContent"><p>
                        <?php
                            if($option == 1)
                                echo $question->description;
                             else
                                echo $question->recipe;                            

                        ?>
                    </p></div>
                    <table id="learnLower">
                        <tr>
                            <td class="" style="text-align: left;"><a href="#" style="padding-left: 10%;">Share Info</a></td>
                            <td class="" style="text-align: right;"><a href="challenge.php" style="padding-right: 10%;">Move On!</a></td>
                        </tr>
                    </table>
         <?php include_once "comp/menu.php"; ?>               
        <script src="js/fontScaler.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        
        <script>
            var questionImage = document.getElementById('questionImage');
            questionImage.style.height = (window.innerHeight * 0.28) + 'px';
            var learnMenu = document.getElementById('learnMenu');
            var learnLower = document.getElementById('learnLower');
            var questionContent = document.getElementById('questionContent');

            questionContent.style.height = (window.innerHeight - (document.getElementById('header').clientHeight + questionImage.clientHeight + learnLower.clientHeight + learnMenu.clientHeight)) + 'px';
         </script>
    
         
    </body>
</html>