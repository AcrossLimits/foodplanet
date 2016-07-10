<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="AcrossLimits">
        <title>Europeana Food & Drink</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/dialog.css">
        <link rel="stylesheet" href="css/fonts.css">
    </head>
    <body>
        <div id="loginWrapper">
            <div id="logoWrapper"><img src="img/logo.png" /></div>
            <div id="buttonWrapper">
                <div id="buttons">
                    <table class="button facebook" id="btnFacebook">
                        <tr>
                            <td class="icon"><img src="img/icon_facebook.png" /></td>
                            <td class="spacer"></td>
                            <td class="text" data-localize="_login._facebook">Login with Facebook</td>
                        </tr>
                    </table>
                    <table class="button guest" id="btnGuest">
                        <tr>
                            <td class="icon"><img src="img/icon_guest.png" /></td>
                            <td class="spacer"></td>
                            <td class="text" data-localize="_login._guest">Play as a Guest</td>
                        </tr>
                    </table>
                    <table class="button europeana" id="btnEuropeana">
                        <tr>
                            <td class="icon"><img src="img/icon_europeana_small.png" /></td>
                            <td class="spacer"></td>
                            <td class="text" >Go to <span class="europeanaFont">europeana</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <table id="credits">
            <tr>
                <td><img src="img/fnd.png" /></td>
                <td><img src="img/europeana.png" class="europeana" /></td>
            </tr>
        </table>

        <div class="dialog" id="dialogLogin">
            <div class="blackout"></div>
            <div class="wrapper">
                <div class="animLoaderWrapper">                      
                    <div class="animImage" id="knife"><img src="img/img_knife.png"></div>
                    <div class="animImage" id="glass"><img src="img/img_glass.png"></div>
                    <div class="animImage" id="fork"><img src="img/img_fork.png"></div>
                </div>
                <div data-localize="_login._logging_in">Connecting...</div>
            </div>
        </div>

        
    <script type="text/javascript">
        var dialogLogin = document.getElementById("dialogLogin");
        var btnFacebook = document.getElementById("btnFacebook");
        var btnGuest = document.getElementById("btnGuest");
        var btnEuropeana = document.getElementById("btnEuropeana");

        btnFacebook.onclick = function () { ShowLogin(); window.location = "loginSubmit.php"; };
        btnGuest.onclick = function () { ShowLogin(); window.location = "loginGuest.php"; };
        function ShowLogin() {
            dialogLogin.style.display = 'block';
        }
        btnEuropeana.onclick = function () { if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
         window.top.location = "http://www.europeana.eu/portal/";
        }
    else {
        var win = window.open('http://www.europeana.eu/portal/', '_blank');
        win.focus();
    } };
        

    </script>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>    
        <script src="js/fontScaler.js"></script> 
        <script src="js/jquery.localize.js"></script> 
        <script>
            $("[data-localize]").localize("lang/lang", { skipLanguage: ["en", "en-US"]});
        </script>
    </body>
</html>
