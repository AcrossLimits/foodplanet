<script   data-cfasync="false" type="text/javascript">
    // Main page features
    var page_title = document.getElementById("pageTitle");
    var page_content = document.getElementById("pageContent");
    var header = document.getElementById("header");
    var pageBody = document.getElementsByTagName("body")[0];

    // Gather all pages
    var challenge_start = document.getElementById("challenge_start");
    var challenge_play = document.getElementById("challenge_play");

    // Challenge start declarations
    var challengeStartUpper = document.getElementById("challengeStartUpper");
    var challengeStartMiddle = document.getElementById("challengeStartMiddle");
    var challengeStartLower = document.getElementById("challengeStartLower");

    // Challenge Play declarations
    var questionTitle = document.getElementById("questionTitle");
    var questionWrapper = document.getElementById("questionWrapper");
    var questionLower = document.getElementById("questionLower");
    var answer1 = document.getElementById("answer1");
    var answer2 = document.getElementById("answer2");
    var answer3 = document.getElementById("answer3");
    var answer4 = document.getElementById("answer4");
    var answer1img = document.getElementById("answer1img");
    var answer2img = document.getElementById("answer2img");
    var answer3img = document.getElementById("answer3img");
    var answer4img = document.getElementById("answer4img");
    var question = document.getElementById("question");
    var questionimg = document.getElementById("questionimg");
    var hintOverlay = document.getElementById("hintOverlay");
    var hint = document.getElementById("hint");
    var hintText = document.getElementById("hintText");
    var imgHint = document.getElementById("imgHint");
    var timeBar = document.getElementById("timerBar");
    var flash = document.getElementById("flash");
    var timerValue = document.getElementById("timerValue");
    var sunburst = document.getElementById("sunburst");
    var loading = document.getElementById("loadingScreen");
    var aos1 = document.getElementById("aos1");
    var aos2 = document.getElementById("aos2");
    var aos3 = document.getElementById("aos3");
    var aos4 = document.getElementById("aos4");
    var addedScore = document.getElementById("addedScore");
    var answer = "";
    var foodTitle = "";
    var questionedAnswered = false;
    var totalPoints = 0;
    var countingDown = false;
    var currentDesc = "";
    var currentRecipe = "";
 

    var infoBox = document.getElementById("scrollInfo");
    var infoName = document.getElementById("moreinfoTitle");
    var infoContent = document.getElementById("moreInfoContent");
    var infoImage = document.getElementById("moreinfoUpper");
    var infoEuropeana = document.getElementById("moreInfoEuropeana");
    infoBox.style.display = 'none';
    
    

    <?php         
        $question = new Question;
        $q1 = $question->getQuestion($challenge->questionIDs[0]);
        $q2 = $question->getQuestion($challenge->questionIDs[1]);
        $q3 = $question->getQuestion($challenge->questionIDs[2]);
        $q4 = $question->getQuestion($challenge->questionIDs[3]);
        $q5 = $question->getQuestion($challenge->questionIDs[4]);

        $ra1 = $question->getRandomAnswers($q1->answer->id);
        $ra2 = $question->getRandomAnswers($q2->answer->id);
        $ra3 = $question->getRandomAnswers($q3->answer->id);
        $ra4 = $question->getRandomAnswers($q4->answer->id);
        $ra5 = $question->getRandomAnswers($q5->answer->id);

        $a1 = array($ra1[0],$ra1[1],$ra1[2],$q1->answer);
        $a2 = array($ra2[0],$ra2[1],$ra2[2],$q2->answer);
        $a3 = array($ra3[0],$ra3[1],$ra3[2],$q3->answer);
        $a4 = array($ra4[0],$ra4[1],$ra4[2],$q4->answer);
        $a5 = array($ra5[0],$ra5[1],$ra5[2],$q5->answer);

        shuffle($a1);
        shuffle($a2);
        shuffle($a3);
        shuffle($a4);
        shuffle($a5);

        

        echo "\tvar question_ids = ['".$challenge->questionIDs[0]."','".$challenge->questionIDs[1]."','".$challenge->questionIDs[2]."','".$challenge->questionIDs[3]."','".$challenge->questionIDs[4]."'];\n";

        echo "\tvar array_a1img = ['".$a1[0]->imgURL."','".$a1[1]->imgURL."','".$a1[2]->imgURL."','".$a1[3]->imgURL."'];\n";
        echo "\tvar array_a2img = ['".$a2[0]->imgURL."','".$a2[1]->imgURL."','".$a2[2]->imgURL."','".$a2[3]->imgURL."'];\n";
        echo "\tvar array_a3img = ['".$a3[0]->imgURL."','".$a3[1]->imgURL."','".$a3[2]->imgURL."','".$a3[3]->imgURL."'];\n";
        echo "\tvar array_a4img = ['".$a4[0]->imgURL."','".$a4[1]->imgURL."','".$a4[2]->imgURL."','".$a4[3]->imgURL."'];\n";
        echo "\tvar array_a5img = ['".$a5[0]->imgURL."','".$a5[1]->imgURL."','".$a5[2]->imgURL."','".$a5[3]->imgURL."'];\n";
        
        echo "\tvar array_a1txt = ['".$a1[0]->text."','".$a1[1]->text."','".$a1[2]->text."','".$a1[3]->text."'];\n";
        echo "\tvar array_a2txt = ['".$a2[0]->text."','".$a2[1]->text."','".$a2[2]->text."','".$a2[3]->text."'];\n";
        echo "\tvar array_a3txt = ['".$a3[0]->text."','".$a3[1]->text."','".$a3[2]->text."','".$a3[3]->text."'];\n";
        echo "\tvar array_a4txt = ['".$a4[0]->text."','".$a4[1]->text."','".$a4[2]->text."','".$a4[3]->text."'];\n";
        echo "\tvar array_a5txt = ['".$a5[0]->text."','".$a5[1]->text."','".$a5[2]->text."','".$a5[3]->text."'];\n";

        echo "\tvar qTitles = ['".$q1->title."','".$q2->title."','".$q3->title."','".$q4->title."','".$q5->title."'];\n";
        echo "\tvar qImgs = ['".$q1->imgURL."','".$q2->imgURL."','".$q3->imgURL."','".$q4->imgURL."','".$q5->imgURL."'];\n";
        //echo "\tvar qDescs = ['".$q1->description."','".$q2->description."','".$q3->description."','".$q4->description."','".$q5->description."'];\n"; 
        echo "\tvar answers = ['".$q1->answer->text."','".$q2->answer->text."','".$q3->answer->text."','".$q4->answer->text."','".$q5->answer->text."'];\n";
        echo "\tvar q1Desc = \"".$q1->description."<br><br><b>Question provided by:</b><br>".$q1->provider."\";\n";
        echo "\tvar q2Desc = \"".$q2->description."<br><br><b>Question provided by:</b><br>".$q2->provider."\";\n";
        echo "\tvar q3Desc = \"".$q3->description."<br><br><b>Question provided by:</b><br>".$q3->provider."\";\n";
        echo "\tvar q4Desc = \"".$q4->description."<br><br><b>Question provided by:</b><br>".$q4->provider."\";\n";
        echo "\tvar q5Desc = \"".$q5->description."<br><br><b>Question provided by:</b><br>".$q5->provider."\";\n";

        

        if($opponent->id != NULL)
            echo "\tvar opponentScores = [".$challenge->getOpponentScore($q1->id, $opponent->id).",".$challenge->getOpponentScore($q2->id, $opponent->id).",".$challenge->getOpponentScore($q3->id, $opponent->id).",".$challenge->getOpponentScore($q4->id, $opponent->id).",".$challenge->getOpponentScore($q5->id, $opponent->id)."];";
    ?>


    // Challenge Play Variable
    var hintOpen = false;
    var hintCounter = 0;
    var hintTime = 3;

    var hintNumber = 0;
    var seconds = 100;
    var score = 100;
    var timeUp = false;
    var showingInfo = true;
    var currentQuestion = 1;
    var foodTitle = "";

    var score1 = 0;
    var score2 = 0;
    var score3 = 0;
    var score4 = 0;
    var score5 = 0;

    

    // Store current page
    var current = challenge_start;
    changePage();

    // Handle page changes
    window.onhashchange = changePage;
    function changePage() {
        var hash = window.location.hash;
        current.style.display = 'none';

        switch (hash) {
            case "#start":
                {
                    current = challenge_start;
                    break;
                }
            case "#play":
                {
                    current = challenge_play;
                    break;
                }
            default:
                {
                    current = challenge_start;
                    break;
                }
        }

        document.body.style.backgroundColor = '' + current.getAttribute("data");
        page_title.innerHTML = '' + current.getAttribute("name");
        current.style.display = 'block';

        if (hash == "#start") {
            
            challenge_start.style.top = (header.clientHeight) + 'px';
            
            
        }
        else if (hash == "#play") {
            sunburst.style.height = window.innerHeight + 'px';
            sunburst.style.width = (sunburst.clientHeight * 1.5) +'px';
            loadingScreen.style.height = window.innerHeight + 'px';
            loadingScreen.style.width = window.innerWidth + 'px';
            $( "#loadingScreen").css("zIndex",-1);
            $( "#loadingScreen").css("opacity",0);
            
            questionTitle.style.top = (header.clientHeight) + 'px';
            questionWrapper.style.top = (header.clientHeight + questionTitle.clientHeight) + 'px';
            questionWrapper.style.height = (window.innerHeight - (questionLower.clientHeight + page_title.clientHeight + questionTitle.clientHeight)-1) + 'px';
            flash.style.height = questionWrapper.innerHeight + 'px';
            flash.style.width = questionWrapper.innerWidth + 'px';
            //flash.style.top = (header.clientHeight + questionTitle.clientHeight) + 'px';
            sunburst.style.left = (((questionWrapper.clientWidth/2)-sunburst.clientWidth/2)*1) + 'px';
            sunburst.style.top = (((questionWrapper.clientHeight/2)-sunburst.clientHeight/2)*1) + 'px';
            sunburst.style.display = 'none';
            //var moreInfoContentHeight = moreinfoWrapper.clientHeight - (document.getElementById("moreinfoTitle").clientHeight+document.getElementById("moreinfoUpper").clientHeight + document.getElementById("moreinfoMenu").clientHeight + document.getElementById("moreInfoContinue").clientHeight + 25) + 'px';
            //console.log(""+moreInfoContentHeight);
            //moreInfoContent.style.height = moreInfoContentHeight;
            infoBox.style.display = 'none';
            answer1.style.width = (window.innerWidth * 0.27) + 'px';
            answer1.style.height = answer1.clientWidth + 'px';
            answer2.style.width = answer1.clientWidth + 'px';
            answer2.style.height = answer1.clientWidth + 'px';
            answer3.style.width = answer1.clientWidth + 'px';
            answer3.style.height = answer1.clientWidth + 'px';
            answer4.style.width = answer1.clientWidth + 'px';
            answer4.style.height = answer1.clientWidth + 'px';
            
            question.style.width = (window.innerWidth * 0.65) + 'px';
            question.style.height = question.clientWidth + 'px';
            hintOverlay.style.width = question.clientWidth + 'px';
            hintOverlay.style.height = question.clientWidth + 'px';
            hint.style.height = (question.innerWidth * 0.15) + 'px';
            hint.style.width = hint.clientHeight + 'px';
            $( "#loadingScreen").css("opacity",0);
            $( "#loadingScreen").fadeIn( 500, function() {
                // Animation complete.
                $( ".loadingMessage").css("opacity",100);
                $( "#loadingScreen").css("opacity",100);
                $( "#loadingScreen").css("zIndex",100);
                ShowQuestion(1);  
             });
        }
    };

    function ShowQuestion(number) {
        infoBox.style.display = 'none';
        pageBody.style.overflowY = "hidden";
		
        if (number == 1) {
            answer1img.src = array_a1img[0];
            answer1Text.innerHTML = array_a1txt[0];
            answer2img.src = array_a1img[1];
            answer2Text.innerHTML = array_a1txt[1];
            answer3img.src = array_a1img[2];
            answer3Text.innerHTML = array_a1txt[2];
            answer4img.src = array_a1img[3];
            answer4Text.innerHTML = array_a1txt[3];
            questionimg.src = qImgs[0];
            hintText.innerHTML = "This is known as <p>"+qTitles[0]+"</p>";
            foodTitle = qTitles[0];
            //moreInfoContent.innerHTML = ""+q1Desc;
            answer = answers[0];
    
        }
        else if (number == 2) {
            answer1img.src = array_a2img[0];
            answer1Text.innerHTML = array_a2txt[0];
            answer2img.src = array_a2img[1];
            answer2Text.innerHTML = array_a2txt[1];
            answer3img.src = array_a2img[2];
            answer3Text.innerHTML = array_a2txt[2];
            answer4img.src = array_a2img[3];
            answer4Text.innerHTML = array_a2txt[3];
            questionimg.src = qImgs[1];
            hintText.innerHTML = "This is known as <p>"+qTitles[1]+"</p>";
            answer = answers[1];
            foodTitle = qTitles[1];
            //moreInfoContent.innerHTML = ""+q2Desc;
        }
        else if (number == 3) {
            answer1img.src = array_a3img[0];
            answer1Text.innerHTML = array_a3txt[0];
            answer2img.src = array_a3img[1];
            answer2Text.innerHTML = array_a3txt[1];
            answer3img.src = array_a3img[2];
            answer3Text.innerHTML = array_a3txt[2];
            answer4img.src = array_a3img[3];
            answer4Text.innerHTML = array_a3txt[3];
            questionimg.src = qImgs[2];
            hintText.innerHTML = "This is known as <p>"+qTitles[2]+"</p>";
            answer = answers[2];
            foodTitle = qTitles[2];
            //moreInfoContent.innerHTML = ""+q3Desc;
        }
        else if (number == 4) {
            answer1img.src = array_a4img[0];
            answer1Text.innerHTML = array_a4txt[0];
            answer2img.src = array_a4img[1];
            answer2Text.innerHTML = array_a4txt[1];
            answer3img.src = array_a4img[2];
            answer3Text.innerHTML = array_a4txt[2];
            answer4img.src = array_a4img[3];
            answer4Text.innerHTML = array_a4txt[3];
            questionimg.src = qImgs[3];
            hintText.innerHTML = "This is known as <p>"+qTitles[3]+"</p>";
            answer = answers[3];
            foodTitle = qTitles[3];
            //moreInfoContent.innerHTML = ""+q4Desc;
        }
        else {
            answer1img.src = array_a5img[0];
            answer1Text.innerHTML = array_a5txt[0];
            answer2img.src = array_a5img[1];
            answer2Text.innerHTML = array_a5txt[1];
            answer3img.src = array_a5img[2];
            answer3Text.innerHTML = array_a5txt[2];
            answer4img.src = array_a5img[3];
            answer4Text.innerHTML = array_a5txt[3];
            questionimg.src = qImgs[4];
            hintText.innerHTML = "This is known as <p>"+qTitles[4]+"</p>";
            answer = answers[4];
            foodTitle = qTitles[4];
            //moreInfoContent.innerHTML = ""+q5Desc;
            
        }
            //moreInfoTitle.innerHTML = foodTitle;
            //moreInfoImage.src = questionimg.src;
            //currentDesc = qDescs[number];
            //currentRecipe = qRecipe[number];
            //moreInfoContent.innerHTMl += "This could be a button";

            shareImage = questionimg.src;
            shareTitle = "I just learnt about " + foodTitle;
            shareDescription = "I just learnt about " + foodTitle + " in Food Planet. Do you know where it's from?";

            var fbShareBtn = document.querySelector('.fb_share');
            fbShareBtn.addEventListener('click', function (e) {
                e.preventDefault();
                var title = shareTitle,
                desc = shareDescription,
                url = fbShareBtn.getAttribute('href'),
                image = shareImage;
                //postToFeed(title, desc, url, image);
				facebookShare(desc);
                return false;
            });
            

        questionTitle.innerHTML = "Where on earth is this from?";
        sunburst.style.display = 'none';
        $(".answerOverlay").css("display", "none");
        if(answer1Text.innerHTML == answer) {
            aos1.className="symbol correct";
            aos1.innerHTML="✔";
        }
        else {
            aos1.className="symbol wrong";
            aos1.innerHTML="x";
        }
        if(answer2Text.innerHTML == answer) {
            aos2.className="symbol correct";
            aos2.innerHTML="✔";
        }
        else {
            aos2.className="symbol wrong";
            aos2.innerHTML="x";
        }
        if(answer3Text.innerHTML == answer) {
            aos3.className="symbol correct bottom";
            aos3.innerHTML="✔";
        }
        else {
            aos3.className="symbol wrong bottom";
            aos3.innerHTML="x";
        }
        if(answer4Text.innerHTML == answer) {
            aos4.className="symbol correct bottom";
            aos4.innerHTML="✔";
        }
        else {
            aos4.className="symbol wrong bottom";
            aos4.innerHTML="x";
        }
        page_title.innerHTML = 'Question ' + number + '/5';
        hintNumber = 0;
        score = 100;
        showingInfo = false;
		timerValue.innerHTML = "";
	timerValue.style.textAlign = "left";
		timerValue.style.left = "0.5em";
        timerBar.style.width = score + '%';
        timerValue.innerHTML = score + ' Points';
        timeUp = false;
        questionAnswered = false;
        currentQuestion = number;
        countingDown = false;
        hint.style.display = 'block';
        imgHint.src = "img/img_hint.png";
        $("#question").css("opacity", "0");
            $('#question').animate({
                opacity: 1
            }, 600, function () {
                
            });
        $(".answer").css("opacity", "0");
            $('.answer').animate({
                opacity: 1
            }, 880, function () {
                
            });
        $('#questionimg').on('load', function() {
            $( "#loadingScreen").css("opacity",100);
            $( ".loadingMessage").css("opacity",0);
            $( "#loadingScreen").fadeOut( 500, function() {
                // Animation complete.
                
                $( "#loadingScreen").css("opacity",0);
                $( "#loadingScreen").css("zIndex",-1);
                $("#answer1").css("zIndex",10);
                $("#answer2").css("zIndex",10);
                $("#answer3").css("zIndex",10);
                $("#answer4").css("zIndex",10);
                $("#question").css("zIndex",5);
                StartCountdown();     
              });
                
        });
        
    };

    function pressBack() {
        var hash = window.location.hash;
        if (hash == "#end") {
            window.location = "page.php#dashboard";
        }
        else {
            // do nothing
        }
    };

    function StartCountdown() {
        if(!countingDown) {
            countingDown = true;
            score = 100;

            Countdown();
        }
    };

    function Countdown() {
        
            if (score <= 0) {
                // Time up
                timerBar.style.width = score + '%';
                timerValue.innerHTML = score + ' Points';
                timeUp = true;
                questionAnswered = true;
                Flash(false);
                questionimg.src = "img/questions/img_questionTime.png";
                //if(currentQuestion < 5)
                    //ShowQuestion(currentQuestion+1);
            }
            else if(!questionAnswered) {
            
                score -= 1;
                timerBar.style.width = score + '%';
                timerValue.innerHTML = score + ' Points';
                timeoutMyOswego = setTimeout(Countdown, 80);
            }

            else {
            }        
    };

    function ShowItemInfo(itemID) {
        "use strict";
        $.ajax({
            type:"GET", 
            url: "https://fnd.acrosslimits.com/getItemInformation.php",
            data: "itemID="+itemID, 
            success: function(data) {

                    infoBox.style.display = 'block';
                    var splitData = data.split("##");
                    var europeana = splitData[4];
                    var provider = splitData[3];
                    
                    var content = splitData[2];
                    if(provider != "") {
                        content += "</br></br>Provided by:</br>"+provider;
    }
                    infoName.innerHTML = splitData[0];
                    infoContent.innerHTML = content;
                    if(europeana == ""){
                        infoEuropeana.innerHTML = "<a><img src='img/icon_vieweuropeana.png' alt='' /></a>";
                        if($("#moreInfoEuropeana").hasClass("europeana")){
                            $("#moreInfoEuropeana").removeClass("europeana");
                                
                         }
                    }
                    else{
                        if(!$("#moreInfoEuropeana").hasClass("europeana")){
                            $("#moreInfoEuropeana").addClass("europeana");
                         }
                        infoEuropeana.innerHTML = "<a href='"+europeana+"' target='_blank'><img src='img/icon_vieweuropeana.png' alt='' /></a>";}
                    infoImage.innerHTML = "<img src='img/questions/"+splitData[1]+"' alt=''/>";
                    
                    
                }, 
            error: function(jqXHR, textStatus, errorThrown) {
                    //console.log("Unable to get item information");
                }});}

    timerBar.onclick = function() {
        if(timeUp) {
            //showingInfo = true;
            //ShowItemInfo(question_ids[currentQuestion-1]);
            //moreInfo.style.display = 'block';
        }
    };

    timerValue.onclick = function() {
        if(timeUp) {
            //showingInfo = true;
            //ShowItemInfo(question_ids[currentQuestion-1]);
            //moreInfo.style.display = 'block';
        }
    };
    /*
    moreInfoContinue.onclick = function() {
        
        if(showingInfo) {
            console.log("clicked");
            infoBox.style.display = 'none';
            showingInfo = false;
            if(questionAnswered && currentQuestion < 5) {
            
                $( "#loadingScreen").hide();
                $( "#loadingScreen").fadeIn( 0, function() {
                    // Animation complete.
                    $( ".loadingMessage").css("opacity",100);
                    $( "#loadingScreen").css("opacity",100);
                    $( "#loadingScreen").css("zIndex",100);
                    ShowQuestion(currentQuestion+1);  
                 });            
            }

            if(questionAnswered && currentQuestion >= 5) {
                var shareCount = 0;
                if(sessionStorage.shareCount)
                    shareCount = sessionStorage.shareCount;
                window.location = "challengeEnd.php?cid=<?php echo $challenge->id;?>&ts="+totalPoints+"&s1="+score1+"&s2="+score2+"&s3="+score3+"&s4="+score4+"&s5="+score5+"&sh="+shareCount;
            }            
        }
    };
    */
    function Flash(correct) {
        $("#answer1").css("zIndex",1);
        $("#answer2").css("zIndex",1);
        $("#answer3").css("zIndex",1);
        $("#answer4").css("zIndex",1);
        $("#question").css("zIndex",10);
        $("#sunburst").css("zIndex",4);
        ShowItemInfo(question_ids[currentQuestion-1]);
        pageBody.style.overflowY = "visible";
        //infoBox.style.display = 'block';
        timeUp = true;
        if(correct) {
            $("#flash").css("background", "#098b0c");
            $("#flash").css("display", "block");
            $("#flash").css("opacity", "1");
            hint.style.display = 'none';
            hintOverlay.style.display = 'none';
            $(".answerOverlay").css("display", "block");
            sunburst.style.display = 'block';
            addedScore.innerHTML = "+"+score;
            if(currentQuestion == 1)
                score1 = score;
            else if(currentQuestion == 2)
                score2 = score;
            else if(currentQuestion == 3)
                        score3 = score;
            else if(currentQuestion == 4)
                        score4 = score;
            else
                score5 = score;
            $("#addedScore").css("top", "10%");
            $("#addedScore").css("display", "block");
            $("#addedScore").css("opacity", "1");
            $('#addedScore').animate({
                opacity: 0,
                top: '-50%'
            }, 1200, function () {
                $("#addedScore").css("display", "none");
                $("#addedScore").css("top", "10%");
                $("#addedScore").css("opacity", "1");
            });
            $('#flash').animate({
                opacity: 0,
            }, 500, function () {
                $("#flash").css("display", "none");
                
            });
            
        }

        else {
            $("#flash").css("background", "#c21212");
            $("#flash").css("display", "block");
            $("#flash").css("opacity", "1");     
            $(".answerOverlay").css("display", "block");
            hint.style.display = 'none';
            hintOverlay.style.display = 'none';       
            $('#flash').animate({
                opacity: 0,
            }, 500, function () {
                $("#flash").css("display", "none");
            });
        }
        
            score = 100;
            timerBar.style.width = score + '%';
            timerValue.innerHTML = "▼ Scroll Down to learn more! ▼";
			timerValue.style.textAlign = "center";
	timerValue.style.left = "0px";
            questionTitle.innerHTML = foodTitle;

    };


    answer1.onclick = function () {
        if(!timeUp && !questionAnswered) {
            // correct
            if(answer1Text.innerHTML == answer) {
                totalPoints += score;
                Flash(true);
                questionimg.src = "img/questions/img_questionCorrect.png";
                

            }
            else {
              Flash(false);
              questionimg.src = "img/questions/img_questionWrong.png";  
            }
            questionAnswered = true;
            hint.style.display = 'none';
            hintOverlay.style.display = 'none';
        }
    };

    answer2.onclick = function () {
        if(!timeUp && !questionAnswered) {
            if(answer2Text.innerHTML == answer) {
    totalPoints += score;            
    Flash(true);
                questionimg.src = "img/questions/img_questionCorrect.png";
                
            }
            else {
            Flash(false);
              questionimg.src = "img/questions/img_questionWrong.png";  
            }
            questionAnswered = true;
            hint.style.display = 'none';
            hintOverlay.style.display = 'none';
        }
    };

    answer3.onclick = function () {
        if(!timeUp && !questionAnswered) {
            if(answer3Text.innerHTML == answer) {
            totalPoints += score;            
            Flash(true);
                questionimg.src = "img/questions/img_questionCorrect.png";
                
            }
            else {
            Flash(false);
              questionimg.src = "img/questions/img_questionWrong.png";  
            }
            questionAnswered = true;
            hint.style.display = 'none';
            hintOverlay.style.display = 'none';
        }
    };

    answer4.onclick = function () {
        if(!timeUp && !questionAnswered) {
            if(answer4Text.innerHTML == answer) {
    totalPoints += score;            
    Flash(true);
                questionimg.src = "img/questions/img_questionCorrect.png";
                
            }
            else {
                Flash(false);
              questionimg.src = "img/questions/img_questionWrong.png";  
            }
            questionAnswered = true;
            hint.style.display = 'none';
            hintOverlay.style.display = 'none';
        }
    };

    question.onclick = function () {
        if(questionAnswered && currentQuestion < 5) {
            
			
            $( "#loadingScreen").hide();
            $( "#loadingScreen").fadeIn( 500, function() {
                // Animation complete.
                $( ".loadingMessage").css("opacity",100);
                $( "#loadingScreen").css("opacity",100);
				
                $( "#loadingScreen").css("zIndex",100);
                ShowQuestion(currentQuestion+1);  
             });
            

        }

        if(questionAnswered && currentQuestion >= 5) {
            var shareCount = 0;
            if(sessionStorage.shareCount)
                shareCount = sessionStorage.shareCount;
            window.location = "challengeEnd.php?cid=<?php echo $challenge->id;?>&ts="+totalPoints+"&s1="+score1+"&s2="+score2+"&s3="+score3+"&s4="+score4+"&s5="+score5+"&sh="+shareCount;
        }
        
    };

    
    </script>