<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    session_start(); 
    $_SESSION["m"] = 0;
    if(isset($_GET["m"])) {
        $_SESSION["m"] = 1;
    }
    

    include_once('classes/GameManager.php');

    $gameManager = new GameManager;
    if($gameManager::$MAINTENANCE) {
        header("Location: maintenance.php");
    }

    else {
    $onFacebook = FALSE;
    // Check to see if user exists in session
    if ($_SESSION['FBID']) {
        // If they do, move on to the homepage
         header("Location: https://fnd.acrosslimits.com/splash.php?dest=1");
    }
    
    // Otherwise redirect to login screen
    else {
        if(isset($_GET["fb"]) && (intval($_GET["fb"])== 1)) {
            $onFacebook = TRUE;
        }
        else {
            header("Location: https://fnd.acrosslimits.com/splash.php?dest=2");
        }
    }
    }

    

?>

<html>
<head>
</head>
<body>
    <h1 id="fb-welcome"></h1>
    <script>

        var parentFrame = parent.document.getElementById("webFrame");

        if (parentFrame != null) {
            parentFrame.style.width = "330px";
            console.log("Parent frame adjusted");
        }
        else {
            console.log("Could not find parent frame");
        }



        window.fbAsyncInit = function () {
            FB.init({
                appId: '437361289786278',
                xfbml: true,
                version: 'v2.4'
            });

            function onLogin(response) {
                if (response.status == 'connected') {
                    FB.api('/me?fields=first_name', function (data) {
                        var welcomeBlock = document.getElementById('fb-welcome');
                        welcomeBlock.innerHTML = 'Hello, ' + data.first_name + '!';
                    });
                }
            }

            FB.getLoginStatus(function (response) {
                // Check login status on load, and if the user is
                // already logged in, go directly to the welcome message.
                if (response.status == 'connected') {
                    onLogin(response);
                } else {
                    // Otherwise, show Login dialog first.
                    FB.login(function (response) {
                        onLogin(response);
                    }, { scope: 'user_friends, email' });
                }
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        } (document, 'script', 'facebook-jssdk'));
    </script>
    
</body>
</html>