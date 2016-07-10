<div id="challenge_play" class="page" data="#bbe5fa" name="Start Challenge">
    <div id="questionTitle"  data-localize="_challenge._whereonearth">Where on earth is this from?</div>
    <div id="questionWrapper">
        <div id="answer1" class="answer">
            <img src="" id="answer1img" />
            <div class="answerOverlay"><div class="symbol correct" id="aos1">✔</div></div>
            <h1 class="ribbon top">
               <strong class="ribbon-content" id="answer1Text"></strong>
            </h1>
        </div>
        <div id="answer2" class="answer">
            <img src="" id="answer2img" />
            <div class="answerOverlay"><div class="symbol wrong" id="aos2">x</div></div>
            <h1 class="ribbon top">
               <strong class="ribbon-content" id="answer2Text"></strong>
            </h1>
        </div>
        <div id="answer3" class="answer">
            <img src="" id="answer3img" />
            <div class="answerOverlay"><div class="symbol wrong bottom" id="aos3">x</div></div>
            <h1 class="ribbon bottom">
               <strong class="ribbon-content" id="answer3Text"></strong>
            </h1>
        </div>
        <div id="answer4" class="answer">
            <img src="" id="answer4img" />
            <div class="answerOverlay"><div class="symbol correct bottom" id="aos4">✔</div></div>
            <h1 class="ribbon bottom">
               <strong class="ribbon-content" id="answer4Text"></strong>
            </h1>
        </div>
        <div id="sunburst"><img src="img/sunburst.png" /></div>
        <div id="question">
            
            <img src="" id="questionimg" />
            <div id="hintOverlay">
                <div class="hintTitle">Hint</div>
                <div class="hintText" id="hintText">This is known as <p>Item Name</p></div>
            </div>
            <div id="hint">
                <img src="img/img_hint.png" id="imgHint" />
            </div>
            <div id="addedScore">+80</div>
        </div>
        <div id="flash"></div>
    </div>


    <div id="questionLower">
        <div id="questionTimeDeduction">-10</div>
        <div id="timerBar"></div>
        <div id="timerValue">100 Points</div>
    </div>


    
    <div id="scrollInfo">
        <div class="title" id="moreinfoTitle">Food Name</div>
        <div class="upper" id="moreinfoUpper"><img src="img/questions/12.jpg"  id="moreinfoUpperImg" /></div>
        <table class="menu" id="moreinfoMenu">
            <tr><td>Description</td></tr>
        </table>
        <div class="content" id="moreInfoContent">This is where the content goes</div>
        <div class="buttonWrapper" id="moreInfoShare">

            <table class="buttonTable">
                <tr>
                    <td>
                        <div class="button europeana" id="moreInfoEuropeana">
                            <img src="img/icon_vieweuropeana.png" alt="" />
                        </div>
                        <div class="subtext" id="showWhatIs"><a>What is Europeana?</a></div>
                    </td>
                    <td>
                        <div class="button share"><div>
                            <a href="http://bit.ly/FoodPlanetGame" data-image="http://fnd.acrosslimits.com/img/facebookWinner.png" data-title="I beat XXX in Food Planet!" data-desc="I just beat XXX in Food Planet with a score of YYY! How will you do?" class="fb_share"  id="dialogInfoShare">
                                Share     
                            </a></div>
                        </div>
                    </td>
                </tr>
            </table>            
        </div>      
    </div>

    <div id="whatIs">
        <div class="blackout"></div>
        <div class="wrapper" id="whatIsWrapper">
            <p class="imgWrapper"><img src="img/logo_europeana.png" /></p>
            <p  data-localize="_europeana._upper">Europeana brings together the digitised content of Europe’s galleries, libraries, museums, archives and audiovisual collections. Currently, Europeana gives integrated access to over 53 million books, films, paintings, museum objects and archival documents from some 3,000 content providers.</p>
            <p  data-localize="_europeana._lower">The content is drawn from every European member state and the interface is in 29 European languages. Europeana receives its main funding from the European Commission.</p>        
            <div data-localize="_europeana._close" class="close" id="whatIsClose">Close</div>
        </div>
    </div>

    <?php //include_once("components/moreinfo.php"); ?>

    <div id="loadingScreen">
        <div class="loadingMessage"  data-localize="_challenge._loading">Loading...</div>
    </div>



</div>