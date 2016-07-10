<?php 
?>

<style>


#dialogGuest {
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    display:  none;
    z-index:2001;
    
}

#dialogGuest .blackout {
    width: 100%;
    height: 100%;
    background-color: black;
    -moz-opacity: 0.9;
    opacity:.90;
    filter: alpha(opacity=90);
}

#dialogGuest .wrapper {
    position: absolute;
    top: 15%;
    left: 50%;
    width: 69%;
    background-color: #fff;
    transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
}

#dialogGuest .wrapper .title {
    width:  100%;
    text-align: center;
    font-size:  0.9em;
    font-weight:  bold;
    color:  #fff;
    margin-bottom:  1%;
    padding:  4% 0% 4% 0%;
    background-color:  #e70606;
    border-bottom: 2px solid #b10e0e;
    text-shadow: 1px 1px 2px #000;
}
    
#dialogGuest .wrapper .mainText {
        font-size:  0.8em;
        width: 100%;
        text-align: center;
        font-weight: bold;
        color: #444;
        margin-top: 5%;
    }
    
    #dialogGuest .wrapper .subText {
        font-size:  0.7em;
        width: 90%;
        text-align: center;
        font-weight: bold;
        color: #777;
        margin: 5% auto 5%;
    }

#dialogGuest .wrapper table {
    width:  100%;
    border-collapse: collapse;
}

#dialogGuest .wrapper table td {
    vertical-align: top;
}
    
#dialogGuest .wrapper .icon {
        width: 30%;
        margin: 6% auto 0px;
    }

#dialogGuest .wrapper .icon img {
    width:  100%;
    vertical-align: top;
    border-radius: 100px;
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
    margin-left: -5%;
}
    
    

#dialogGuest .wrapper table img {
    width:  100%;
    height:  auto;
    vertical-align: top;
}

#dialogGuest .wrapper table .badgeName {
    font-size:  0.6em;
    font-weight:  bold;
    padding-top:  7%;
    width:  100%;
    
}

#dialogGuest .wrapper table .badgeDescription {
    padding-top: 2%;
    padding-bottom:  2%;
    font-size:  0.5em;
    font-weight:  normal;
    width:  100%;
}

#dialogGuest .wrapper .dismiss {
    width:  100%;
    font-weight: bold;
    color:  #555;
    font-size:  0.6em;
    text-align: center;
    /*border-top:  1px solid #005d83;*/
    border-top:  1px solid #fafafa;
    padding-top: 3%;
    padding-bottom:  3%;
}

</style>

<div id="dialogGuest">
    <div class="blackout"></div>
    <div class="wrapper" id="dialogGuestWrapper">
        <div class="title">Guest Mode</div>
        <div class="icon"><img src="../img/imgGuest.png"  style="background-color:  #ccc; border:  3px solid #444;" /></div>
        <div class="mainText">You are playing as a guest</div>
        <div class="subText">Log in with Facebook to unlock this and other features</div>
        <div class="dismiss">Dismiss</div>
    </div>
</div>

<script>
    var dialogGuestMain = document.getElementById("dialogGuest");
    var dialogGuestWrapper = document.getElementById("dialogGuestWrapper");

    function displayGuestMessage() {
        dialogGuestMain.style.display = "block";
    }

    dialogGuestWrapper.onclick = function () { dialogGuestMain.style.display = "none"; };
</script>