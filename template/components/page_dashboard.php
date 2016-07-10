<div id="page_dashboard" class="page" data="#bbe5fa" name="Food Planet">
                <div class="upper"><span class="fade-in"><span data-localize="_home._welcome_left">Hey </span><?php echo $user->name;?><span data-localize="_home._welcome_right">! Welcome back</span></span></div>
                <div class="dashboardUserPhoto">
                    <img src="<?php echo $user->pictureURL; ?>" alt="" id="dashboardPhoto" class="fade-in one"/>
                </div>
                <div class="dashboardOptions">
                    <table class="tblOptions">
                        <tr>
                            <td class="option"><a href="chal.php#start"><img src="img/imgChallenge.png" alt="" class="fade-in two"></a></td>
                            <td class="optionSpacer"></td>
                            <td class="option"><img src="img/imgGetBadges.png" id="btnDashboardBadges" alt="" class="fade-in two"></a></td>
                        </tr>
                    </table>
                </div>
                <div class="dashboardLanguage fade-in two languageSelect">
                    <select id="selectLanguage" onchange="changeLanguage()">
                        
                        <option value="en">Select Language</option>
                        <option value="en">English</option>
                        <option value="ca">Català</option>
                        <option value="de">Deutsch</option>
                        <option value="es">Español</option>
                        <option value="fr-FR">Français</option>
                        <option value="gr">ελληνικά</option>
                        <option value="hu">magyar</option>
                        <option value="it">Italiano</option>
                        <option value="lt">Lietuvių</option>
                        <option value="mt">Malti</option>
                        <option value="nl">Nederlands</option>
                        <option value="pl">Polski</option>
                        <option value="sl">Slovenčina</option>
                    </select>
                </div>
                
                <table id="lowerUpload" class="dashboardLower fade-in three">
                <tr>
                    <td class="lowerLeft">
                        <div class="top" data-localize="_home._sendmeal">Send meal to cyberspace</div>
                        <div class="bottom" data-localize="_home._uploadphotos">Upload photos of your dishes</div>
                    </td>
                    <td>
                        <div class="arrow">></div>
                    </td>
                </tr>            
            </table>
            </div>

<script>
    var btnBadges = document.getElementById("btnDashboardBadges");
    btnBadges.onclick = function() {ClickDashboardBadges()};
    function ClickDashboardBadges() {
        if("<?php echo $uid;?>" == "Guest")
            displayGuestMessage();
        else {
            window.location = "#badges";
        }
    };

    var uploadButton = document.getElementById("lowerUpload");
    uploadButton.onclick = function() {ClickDashboardUpload()};
    function ClickDashboardUpload() {
        if("<?php echo $uid;?>" == "Guest")
            displayGuestMessage();
        else {
            window.location = "#upload";
        }
    };

    function changeLanguage() {
        var lang = document.getElementById("selectLanguage").value;
        var userid_ = <?php echo $uid;?>;
        window.location = 'changeLanguage.php?uid='+userid_+'&lang='+lang+'';

    }
</script>
