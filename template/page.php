<?php 
    
    // Page Header
    include_once("components/header.php");    
?>

<div id="pageTitles" style="display: none">
    <div id="pageTitleHome">Food Planet</div>
    <div id="pageTitleBadges" data-localize="_home._badges">Badges</div>
    <div id="pageTitleLeaderboard" data-localize="_navigation._leaderboard">Leaderboard</div>
    <div id="pageTitleCatalog" data-localize="_navigation._catalog">Catalog</div>
    <div id="pageTitleAbout" data-localize="_navigation._about">About</div>    
</div>

<div id="pageContent">
    <?php
        // Dashboard
        include_once("components/page_dashboard.php");

        // Badges
        include_once("components/page_badges.php");

        // Leaderboards
        include_once("components/page_leaderboard.php");

        // Leaderboards
        include_once("components/page_catalog.php");

        // About
        include_once("components/page_about.php");

        // Upload
        include_once("components/page_upload.php");

        // Upload Success
        include_once("components/page_uploadSuccess.php");

        // Upload Failed
        include_once("components/page_uploadFailed.php");

        // Europeana
        include_once("components/page_europeana.php");

        if($user->statusID == 2) {
            include_once("components/page_verify.php");
        }
    ?>            
</div>

    <?php        
        // Main Menu
        include_once("components/menu.php");
    ?>

    <?php
        // Dialogs
        include_once "components/dialogs/dialogBadgeInformation.php";
        include_once "components/dialogs/dialogBadgeOwned.php";     
        include_once "components/dialogs/dialogBadgeUnlocked.php";
        include_once "components/dialogs/dialogGuest.php";
    ?>

        
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>    
    <script src="js/fontScaler.js"></script> 
    <script src="js/jquery.localize.js"></script>
    <script>
            $("[data-localize]").localize("lang/lang", { skipLanguage: ["en", "en-US"], language: "<?php echo $user->lang;?>"});
        </script>
    <?php
        

        // Page Switcher
        include_once('components/js_pageSwitcher.php');   
        
        // Main menu controller
        include_once('components/js_menu.php'); 

        // Dashboard Javascript
        include_once('components/js_dashboard.php');     

        // Badges Javascript
        include_once('components/js_badges.php');

        // Leaderboard Javascript
        include_once('components/js_leaderboard.php');

        // Catalog Javascript
        include_once('components/js_catalog.php');

        // Upload Javascript
        include_once('components/js_upload.php');

        // Verify Javascript
        include_once('components/js_verify.php');

        // Verify Javascript
        include_once('components/js_europeana.php');

        // Google Tracking
        //include_once('components/js_googleanalytics.php')


    ?>
        
    </body>
</html>
