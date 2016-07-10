<?php

?>

<style>

    html, body {
        background-color: #82358b;
    }
    
    .logo {
        width: 80%;
        height: auto;
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    
    .logo img {
        width: 100%;
        height: auto;
    }
    
</style>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <title></title>
    </head>
    <body>
        <div id="logo" class="logo"><img src="img/logo_al.png"</div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#logo").fadeIn(2000);
            setTimeout(continueExecution, 3500)
        });

        function continueExecution() {
            var dest = getParameterByName('dest');
            if(dest == 1) {
                window.location="https://fnd.acrosslimits.com/page.php#dashboard";
            }
            else {
                window.location="https://fnd.acrosslimits.com/login.php";
            }
        }

        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    </script>
</html>
