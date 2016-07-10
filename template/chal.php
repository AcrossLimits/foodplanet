<?php 
    // Challenge Header
    include_once("components/challenge_header.php");    
?>

<div id="pageContent">
    <?php
        // Challenge Start Page
        include_once("components/challenge_start.php");

        // Challenge Play Page
        include_once("components/challenge_play.php");
    ?>            
</div>

    <?php
        // Dialogs
    ?>

        
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>    
    <script src="js/fontScaler.js"></script> 
    <script src="js/jquery.localize.js"></script>
        <script>
                $("[data-localize]").localize("lang/lang", { skipLanguage: ["en", "en-US"], language: "<?php echo $user->lang;?>"});
            </script>
    <?php
        // Page Switcher
        include_once('components/js_challenge_pageSwitcher.php');   

        // Challenge Start
        include_once('components/js_challenge_start.php');  

        // Challenge Play
        include_once('components/js_challenge_play.php');  
    ?>
                <script type="text/javascript">
                var shareButton;
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

    </body>
</html>
