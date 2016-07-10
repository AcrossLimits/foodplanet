<style>
    
#moreInfo
{
    position: absolute;
    width:  100%;
    height:  100%;
    top:  0px;
    left:  0px;
        display:  none;
    z-index:  65;
}

#moreInfo .blackout {
    background: rgba(0, 0, 0, .8);
    width:  100%;
    height:  100%;
}

#moreInfo .wrapper {
    width:  85%;
    position: absolute;
    height:  85%;
    top:  50%;
    left:  50%;
    transform: translate(-50%,-50%);
    -webkit-transform: translate(-50%,-50%);
    
}
#moreInfo .wrapper .title {
    width: 100%;
    padding:  1% 0px 2% 0px;
    background-color:  #ff0000;
    border-bottom: 2px solid #b30303;
    color:  #fff;
    font-weight:  bold;
    font-size: 0.7em;
    text-shadow:  1px 1px 1px #000;
    text-align: center;
    font-family: 'Open Sans Semi Bold', sans-serif;
    height: 2.5%;
}

#moreInfo .wrapper .upper {
    width:  100%;
    position: relative;
    overflow: hidden;
    margin-top: -1px;
    height: 25%;
    padding-bottom: 0%;
}

#moreInfo .wrapper .upper img {
    width:  102%;
    height:  auto;
    position: absolute;
    transform: translate(0%,-20%);
    -webkit-transform: translate(0%,-20%);
}

#moreInfo .wrapper .menu {
    width:  100%;
    color:  #000;
    padding: 1% 0px 2% 0px;
    font-size:  0.5em;
    text-align: center;
    background-color: #ffffff;
    border-collapse: collapse;
    margin-top:  0px;
    font-weight:  bold;
    border-bottom: 2px solid #233a47;
    border-top: 1px solid #233a47;
    height: 2.5%;
}

#moreInfo .wrapper .menu td {
    vertical-align: top;
    width:  50%;
    padding: 2% 0px 2% 0px;    
}



#moreInfo .wrapper .content {
    background-color: #bbe5fa;
    padding: 10px;
    font-size: 0.55em;
    text-align: justify;
    overflow-y: scroll;
    font-family: 'Open Sans Semi Bold', sans-serif;
    line-height: 1.25em;
    height:  41%;
}
    
#moreInfo .wrapper .buttonWrapper {
        height:  15%;
        background-color: #ffffff;
    }
    
#moreInfo .wrapper .buttonTable {
        margin: 0px auto 0px;
        width: 98%;
    }
    
#moreInfo .wrapper .buttonTable td {
    vertical-align: top;
    width: 50%;
}
    
 #moreInfo .wrapper .buttonTable .button {
        width: 93%;
        background-color: #bbb;
        text-align: center;
        font-size: 0.6em;
        color: #fff;
        height: 2.6em;
        margin: 5% auto 0px;
        border-bottom: 4px solid #888;
    }
    
    #moreInfo .wrapper .buttonTable .button a {
        
        color: #fff;
        text-decoration:  none;
    }
    
    #moreInfo .wrapper .buttonTable .button img {
        
        height: 2.6em;
        width: auto;
    }
    
    #moreInfo .wrapper .buttonTable .subtext {
        text-align:  center;
        text-decoration-line: underline;
        color: #5d7733;
        font-size: 0.5em;
        margin-top: 3%;
    }
    
    #moreInfo .wrapper .buttonTable .subtext a {
        color: #5d7733;
    }
    
     #moreInfo .wrapper .buttonTable .button.europeana {
        background-color: #92bb51;
        border-bottom: 4px solid #5d7733;
    }
    
    #moreInfo .wrapper .buttonTable .button.share {
        background-color: #2273a6;
        border-bottom: 4px solid #0f4b64;
    }
    
    #moreInfo .wrapper .buttonTable .button.share div {
        padding-top: 0.7em;
    }
    
    

#moreInfo .wrapper .continue {
    background-color: #84a32c;
    font-size: 0.6em;
    color: #fff;
    font-weight: bold;
    height: 5%;
    padding: 4px 0px 0px 0px;
    bottom: 0px;
    font-family: 'Open Sans Semi Bold', sans-serif;
    text-shadow:  1px 1px 1px #000;
    border-bottom: 2px solid #48570b;
}
    
    
    
  
#whatIs
{
    position: fixed;
    width:  100%;
    height:  100%;
    top:  0px;
    left:  0px;
   display: none;
    z-index:  65;
}

#whatIs .blackout {
    background: rgba(0, 0, 0, .8);
    width:  100%;
    height:  100%;
}

#whatIs .wrapper {
    width:  85%;
    position: absolute;
    top:  50%;
    background-color: #fff;
    left:  50%;
    transform: translate(-50%,-50%);
    -webkit-transform: translate(-50%,-50%);
    padding: 0% 0% 5% 0%;
    
}

#whatIs .wrapper p {
    width:  90%;
    height:  auto;
    text-align: justify;
    font-size: 0.7em;
    font-family: 'Open Sans Semi Bold', sans-serif;
    color: #000;
    margin: 5% auto 0px;
    line-height: 1.5em;
}

#whatIs .wrapper .imgWrapper {
   width: 100%;
   text-align: center;
}
    
#whatIs .wrapper p img {
    width:  90%;
    height:  auto;
    text-align: justify;
    font-size: 0.7em;
    font-family: 'Open Sans Semi Bold', sans-serif;
    color: #000;
    margin: 5% auto 0px;
}

#whatIs .close {
    width:  40%;
    font-weight: bold;
    color:  #fff;
    font-size:  0.8em;
    text-align: center;
    /*border-top:  1px solid #005d83;*/
    border-top:  1px solid #fafafa;
    padding: 2% 0% 2% 0%;
    background-color: #e50000;
    margin: 5% auto 0px;
    text-shadow: 1px 1px 1px #000;
}

    
</style>

<script data-cfasync="false" type="text/javascript">
    var shareImage = "";
    var shareTitle = "";
    var shareDescription = "";
</script>

<div id="moreInfo">
    <div class="blackout"></div>
    <div class="wrapper" id="moreinfoWrapper">
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
        <div class="continue" id="moreInfoContinue">Continue</div>
    </div>
</div>

<div id="whatIs">
        <div class="blackout"></div>
        <div class="wrapper" id="whatIsWrapper">
            <p class="imgWrapper"><img src="img/logo_europeana.png" /></p>
            <p  data-localize="_europeana._upper">Europeana brings together the digitised content of Europe’s galleries, libraries, museums, archives and audiovisual collections. Currently, Europeana gives integrated access to over 27 million books, films, paintings, museum objects and archival documents from some 2,200 content providers.</p>
            <p  data-localize="_europeana._lower">The content is drawn from every European member state and the interface is in 29 European languages. Europeana receives its main funding from the European Commission.</p>        
            <div data-localize="_europeana._close" class="close" id="whatIsClose">Close</div>
        </div>
    </div>

<script data-cfasync="false" type="text/javascript">
    var whatIsButton = document.getElementById("showWhatIs");
    var closeWhatIs = document.getElementById("whatIsClose");
    var whatIs = document.getElementById("whatIs");

     whatIsButton.onclick = function () {
        whatIs.style.display = 'block';
    };

    closeWhatIs.onclick = function () {
        whatIs.style.display = 'none';
    }
</script>