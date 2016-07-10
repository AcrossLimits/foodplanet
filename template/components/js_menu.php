<script type="text/javascript">

    $( "#menuOverlay" ).hide();
    $( "#menuRight" ).hide();
    $("#menuLeft").click(function () { 
        
        $( "#menuRight" ).animate({
        left: "+=80%",

      }, 300, function() {
        // Animation complete.
        $( "#menuRight").css("left", "100%");
        $( "#menuRight" ).hide();

        
      });
      $( "#menuOverlay").fadeOut( 300, function() {
            // Animation complete.
            $( "#menuWrapper").css("z-index", -1);
            $( "#menuLeft").css("z-index", -1);
          });
    });

    $("#menuButton").click(function () { 
        $( "#menuWrapper").css("z-index", 1000);
        $( "#menuLeft").css("z-index", 1001);
        $( "#menuRight").css("left", "100%");
        $( "#menuRight" ).show();
        $( "#menuOverlay").fadeIn( 300, function() {
            // Animation complete.
            
          });
          $( "#menuRight" ).animate({
        left: "-=80%",
          }, 300, function() {
              
              $( "#menuWrapper").css("z-index", 1001);
              $( "#menuRight").css("left", "20%");
            // Animation complete.
            });
      });

      var isGuest = false;
      //if("<?php //echo $uid;?>" == "Guest") {
        //isGuest = true;
      //}

    var btnHome = document.getElementById("btnHome");
    var btnBadges = document.getElementById("btnBadges");
    var btnLeaderboard = document.getElementById("btnLeaderboard");
    var btnCatalog = document.getElementById("btnCatalog");
    var btnAbout = document.getElementById("btnAbout");
    var btnSettings = document.getElementById("btnSettings");
    var btnEditProfile = document.getElementById("btnEditProfile");
    var btnLogOut = document.getElementById("btnLogout");
    var btnVerify = document.getElementById("btnVerify");
    var btnEuropeana = document.getElementById("btnEuropeana");

    btnHome.onclick = function() {ClickHome()};
    btnBadges.onclick = function() {ClickBadges()};
    btnLeaderboard.onclick = function() {ClickLeaderboard()};
    btnCatalog.onclick = function() {ClickCatalog()};
    btnAbout.onclick = function() {ClickAbout()};
    btnSettings.onclick = function() {ClickSettings()};
    btnEditProfile.onclick = function() {ClickEditProfile()};
    btnLogOut.onclick = function() {ClickLogout()};
    <?php if($user->statusID == 2) {?>
    btnVerify.onclick = function() {ClickVerify()};
    <?php }?>
    btnEuropeana.onclick = function() {ClickEuropeana()};
        
    function ClickHome() {
        window.location = "#dashboard";
        HideMenuQuick();
    };
    function ClickBadges() {
        if("<?php echo $uid;?>" == "Guest")
            displayGuestMessage();
        else {
            window.location = "#badges";
            HideMenuQuick();
        }
    };
    function ClickCatalog() {
        
            window.location = "#catalog";
            HideMenuQuick();
       
    };
    function ClickLeaderboard() {
        window.location = "#leaderboard";
        HideMenuQuick();
    };
    function ClickAbout() {
        window.location = "#about";
        HideMenuQuick();
    };
    function ClickSettings() {
        window.location = "#settings";
        HideMenuQuick();
    };
    function ClickEditProfile() {
        if("<?php echo $uid;?>" == "Guest")
            displayGuestMessage();
        else {
            window.location = "#editprofile";
            HideMenuQuick();
        }
    };
    function ClickLogout() {
        window.location = "logout.php";
        HideMenuQuick();
    };
    <?php if($user->statusID == 2) {?>
    function ClickVerify() {
        window.location = "#verify";
        HideMenuQuick();
    };
    <?php }?>
    function ClickEuropeana() {
        window.location = "#europeana";
        HideMenuQuick();
    };

    function HideMenuQuick() {
        $( "#menuRight" ).animate({
        left: "+=80%",

      }, 10, function() {
        // Animation complete.
        $( "#menuRight").css("left", "100%");
        $( "#menuRight" ).hide();

        
      });
      $( "#menuOverlay").fadeOut( 300, function() {
            // Animation complete.
            $( "#menuWrapper").css("z-index", -1);
            $( "#menuLeft").css("z-index", -1);
          });
    }

</script>