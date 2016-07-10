<style>
    
    #dialogBadgeUnlocked {
      position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        display:  none;
        z-index:1001;  
    }
    
    #dialogBadgeUnlocked .blackout {
        width: 100%;
        height: 100%;
        background-color: black;
        -moz-opacity: 0.7;
        opacity:.70;
        filter: alpha(opacity=70);
    }
    
    #dialogBadgeUnlocked .wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 70%;
        background-color: #fff;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        
        box-shadow: 0px 0px 8px #000000;
    }
    
    #dialogBadgeUnlocked .title {
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
    
    
    
    #dialogBadgeUnlocked .badgeIcon {
        padding:  5%;
        margin:  0px auto 0px;
        text-align:  center;
    }
    
    #dialogBadgeUnlocked .badgeIcon .outer {
        width:  40%;
        border-radius: 100px;
	    -webkit-border-radius: 100px;
	    -moz-border-radius: 100px;
        margin:  0px auto 0px;
    }
    
    #dialogBadgeUnlocked .badgeIcon img {
        padding:  5px;
        width:  35%;
	    height: auto;
	    border-radius: 100px;
	    -webkit-border-radius: 100px;
	    -moz-border-radius: 100px;
        margin:  0px auto 0px;
    }
    
    #dialogBadgeUnlocked .badgeName {
        width:  100%;
        text-align: center;
        font-size:  0.8em;
        font-weight:  bold;
        color:  #000;
        margin-bottom:  1%;
    }
    
    #dialogBadgeUnlocked .badgeDescription {
        width:  80%;
        text-align: center;
        font-size:  0.6em;
        font-weight:  bold;
        margin:  1% auto 0px;
        color:  #777;
        font-style: italic;
    }
    
    #dialogBadgeUnlocked .badgeUseButton {
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
    
    #dialogBadgeUnlocked .dismiss {
        width:  50%;
        margin:  10% auto 6%;
        font-size:  0.7em;
        font-weight:  bold;
        text-align: center;
        color:  #666;
    }
    
    #dialogBadgeUnlocked .badgeUpdateTitle {
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
    
    #dialogBadgeUnlocked .badgeUpdateTitle:active {
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
    
</style>

<div id="dialogBadgeUnlocked">
    <div class="blackout"></div>
    <div class="wrapper" id="dialogBadgeWrapper">
        <div class="title">Badge Unlocked!</div>
        <div class="badgeIcon" id="dialogBadgeIcon"><img src="../img/badges/06.png"  style="background-color:  #ccc; border:  3px solid #444;" /></div>
        <div class="badgeName" id="dialogBadgeName">North / Central America</div>
        <div class="badgeDescription" id="dialogBadgeDesc">Play against 5 opponents from North / Central America</div>
        <div class="badgeUpdateTitle" id="dialogBadgeUpdateTitle" data-localize="_badges._updatetitle">Update Title</div>
        <div class="dismiss" id="dialogBadgeDimiss" data-localize="_badges._close">Dismiss</div>
    </div>
</div>

<script>
    var badges = [];
    var selectedbadge = 0;
    function setUpBadgeDialog(name, desc, id, borderColor, backgroundColor) {
        document.getElementById('dialogBadgeIcon').innerHTML = "<img src='../img/badges/" + id + ".png'  style='background-color:  " + backgroundColor + "; border:  3px solid " + borderColor + ";' />";
        document.getElementById('dialogBadgeName').innerHTML = name;
        document.getElementById('dialogBadgeDesc').innerHTML = desc;
        selectedbadge = id;
    }

    function displayBadgeDialog() {
        if (badges.length > 0) {
            var badge = badges.pop();
            var newID = badge.id;
            if (newID < 10)
                newID = "0" + newID;
            setUpBadgeDialog(badge.name, badge.description, newID, badge.borderColor, badge.backgroundColor);
            document.getElementById('dialogBadgeUnlocked').style.display = "block";
        }
    }

    function addBadgeToQueue(_name, _desc, _id, _borderColor, _backgroundColor) {
        var badge = { name: "" + _name, description: "" + _desc, id: "" + _id, borderColor: "" + _borderColor, backgroundColor: "" + _backgroundColor };
        badges.push(badge);
    }

    document.getElementById('dialogBadgeDimiss').onclick = function () { dismiss(); };

    function dismiss() {
        document.getElementById('dialogBadgeUnlocked').style.display = "none";
        if (badges.length > 0) {            
            displayBadgeDialog();
        }
    }

    document.getElementById('dialogBadgeUpdateTitle').onclick = function () {
        document.getElementById('dialogBadgeUnlocked').style.display = "none";
        window.location = "updatetitle.php?bID=" + selectedbadge+"&return=2";
    };


</script>