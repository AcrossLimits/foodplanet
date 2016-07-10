<style>
    
    #dialogBadgeOwned {
      position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        display:  none;
        z-index:1001;  
        -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }
    
    #dialogBadgeOwned .blackout {
        width: 100%;
        height: 100%;
        background-color: black;
        -moz-opacity: 0.7;
        opacity:.70;
        filter: alpha(opacity=70);
    }
    
    #dialogBadgeOwned .wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 70%;
        background-color: #fff;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        
        box-shadow: 0px 0px 8px #000000;
    }
    
    #dialogBadgeOwned .title {
        width:  100%;
        text-align: center;
        font-size:  1.0em;
        font-weight:  bold;
        color:  #fff;
        margin-bottom:  1%;
        padding:  4% 0% 4% 0%;
        background-color:  #e70606;
        border-bottom: 2px solid #b10e0e;
        text-shadow: 1px 1px 2px #000;
    }
    
    #dialogBadgeOwned .badgeIcon {
        padding:  5%;
        margin:  0px auto 0px;
        text-align:  center;
    }
    
    #dialogBadgeOwned .badgeIcon .outer {
        width:  40%;
        border-radius: 100px;
	    -webkit-border-radius: 100px;
	    -moz-border-radius: 100px;
        margin:  0px auto 0px;
    }
    
    #dialogBadgeOwned .badgeIcon img {
        padding:  5px;
        width:  35%;
	    height: auto;
	    border-radius: 100px;
	    -webkit-border-radius: 100px;
	    -moz-border-radius: 100px;
        margin:  0px auto 0px;
    }
    
    #dialogBadgeOwned .badgeName {
        width:  100%;
        text-align: center;
        font-size:  0.8em;
        font-weight:  bold;
        color:  #000;
        margin-bottom:  1%;
    }
    
    #dialogBadgeOwned .badgeDescription {
        width:  80%;
        text-align: center;
        font-size:  0.55em;
        font-weight:  bold;
        margin:  1% auto 0px;
        line-height: 1.3em;
        color:  #777;
        font-style: italic;
    }
    
    #dialogBadgeOwned .badgeUseButton {
        width:  50%;
        margin:  15% auto 15%;
        background-color: #84a32c;
        border-bottom:  3px solid #5f7520;
        padding:  3%;
        font-size:  0.7em;
        text-align: center;
        color:  #fff;
        text-shadow: 1px 1px 2px #000;
    }
    
    #dialogBadgeOwned .dismiss {
        position: absolute;
        width:  30%;
        font-size:  0.62em;
        font-weight:  bold;
        text-align: center;
        color:  #666;
        background-color: #e70606;
        border: 1px solid #b10e0e;
        box-shadow: 0px 0px 8px #000000;
        bottom: 15%;
        left: 50%;
        padding: 2px;
        color: #fff;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        text-shadow: 1px 1px 2px #000;
    }
    
    #dialogBadgeOwned .badgeUpdateTitle {
        width: 50%;
        font-size:  0.6em;
        font-weight:  bold;
        text-align: center;
        color:  #fff;
        margin:  6% auto 3%;
        padding: 0.3em;
        background-color: #84a32c;
        border-top: 0px solid #fff;
        border-bottom: 4px solid #5f7520;
        text-shadow: 1px 1px 2px #777;
    }
    
    #dialogBadgeOwned .badgeUpdateTitle:active {
        width: 50%;
        font-weight:  bold;
        text-align: center;
        color:  #fff;
        margin:  6% auto 3%;
        padding: 0.3em;
        background-color: #84a32c;
        border-top: 3px solid #fff;
        border-bottom: 1px solid #5f7520;
    }
    
    #dialogBadgeOwned a {
        text-decoration: none;
    }
    
    #dialogBadgeOwned .badgeShare a {
        text-decoration: none;
    }
    
    #dialogBadgeOwned .badgeShare {
        width: 50%;
        font-size:  0.6em;
        font-weight:  bold;
        text-align: center;
        color:  #fff;
        margin:  4% auto 5% !important;
        padding: 0.25em;
        background-color: #2273a6;
        border-top: 0px solid #fff;
        border-bottom: 4px solid #0f4b64;
        text-shadow: 1px 1px 2px #777;
    }
    
    #dialogBadgeOwned .badgeShare:active {
        width: 50%;
        font-weight:  bold;
        text-align: center;
        color:  #fff;
        margin:  4% auto 5%;
        padding: 0.25em;
        background-color: #2273a6;
        border-top: 3px solid #fff;
        border-bottom: 1px solid #0f4b64;
    }
    
    
</style>

<div id="dialogBadgeOwned">
    <div class="blackout"></div>
    <div class="wrapper" id="dialogBadgeOwnedWrapper">
        <div class="title" data-localize="_badges._tounlock">You unlocked this badge</div>
        <div class="badgeIcon" id="dialogBadgeOwnedIcon"><img src="../img/badges/06.png"  style="background-color:  #ccc; border:  3px solid #444;" /></div>
        <div class="badgeName" id="dialogBadgeOwnedName">North / Central America</div>
        <div class="badgeDescription" id="dialogBadgeOwnedDesc">Play against 5 opponents from North / Central America</div>
        <div class="badgeUpdateTitle" id="dialogBadgeUpdateTitle" data-localize="_badges._updatetitle">Update Title</div>
        <a href="http://bit.ly/FoodPlanetGame" data-image="http://fnd.acrosslimits.com/img/badges/01_locked.png" data-title="I just unlocked the BLA BLA BLA Badge!" data-desc="Such and such just unlocked the BLA BLA BLA badge in Food Planet. Can you?" class="fb_share"  id="dialogBadgeShare">
            <div class="badgeShare" data-localize="_badges._share">Share</div>      
        </a>  
    </div>
    <div class="dismiss" id="dialogBadgeOwnedDimiss" data-localize="_badges._close">Dismiss</div>
</div>

<script>
    var badges = [];
    var selectedbadge = 0;
    var shareButton;
    function setUpBadgeOwnedDialog(name, desc, id, borderColor, backgroundColor) {
        document.getElementById('dialogBadgeOwnedIcon').innerHTML = "<img src='../img/badges/" + id + ".png'  style='background-color:  " + backgroundColor + "; border:  3px solid " + borderColor + ";' />";
        document.getElementById('dialogBadgeOwnedName').innerHTML = name;
        document.getElementById('dialogBadgeOwnedDesc').innerHTML = desc;
        shareImage = "http://fnd.acrosslimits.com/img/facebookBadges/" + id + ".png";
        shareTitle = "I just unlocked the " + name + " badge!";
        shareDescription = "I just unlocked the " + name + " badge in Food Planet. Can you?";
        selectedbadge = id;
    }

    function displayOwnedBadgeDialog() {
        if (badges.length > 0) {
            var badge = badges.pop();
            var newID = badge.id;
            if (newID < 10)
                newID = "0" + newID;
            setUpBadgeOwnedDialog(badge.name, badge.description, newID, badge.borderColor, badge.backgroundColor);
            document.getElementById('dialogBadgeOwned').style.display = "block";
        }
    }

    function addBadgeToQueue(_name, _desc, _id, _borderColor, _backgroundColor) {
        var badge = { name: "" + _name, description: "" + _desc, id: "" + _id, borderColor: "" + _borderColor, backgroundColor: "" + _backgroundColor };
        badges.push(badge);
    }

    document.getElementById('dialogBadgeOwnedDimiss').onclick = function () { dismissOwned(); };

    function dismissOwned() {
        document.getElementById('dialogBadgeOwned').style.display = "none";

    };

    document.getElementById('dialogBadgeUpdateTitle').onclick = function () {
        document.getElementById('dialogBadgeOwned').style.display = "none";
        window.location = "updatetitle.php?bID=" + selectedbadge + "&return=1";
    };

    shareButton = document.getElementById('dialogBadgeShare');
    shareButton.onclick = function () {
        document.getElementById('dialogBadgeOwned').style.display = "none";
    };

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