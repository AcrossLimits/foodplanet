<?php
    include_once('classes/GameManager.php');

    $gameManager = new GameManager;
    if(!$gameManager::$MAINTENANCE) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="AcrossLimits">
        <title>Europeana Food & Drink</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/maintenance.css">
        <link rel="stylesheet" href="css/fonts.css">
    </head>
    <body>
        <div id="loginWrapper">
            <div id="logoWrapper"><img src="img/logo.png" /></div>
            <div id="messageWrapper">
                The game is currently under maintenance, we'll be back shortly!
            </div>
        </div>

        <table id="credits">
            <tr>
                <td><img src="img/fnd.png" /></td>
                <td><img src="img/europeana.png" class="europeana" /></td>
            </tr>
        </table>

        
        <script src="js/fontScaler.js"></script>  
    </body>
</html>
