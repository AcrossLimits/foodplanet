<style>
    
    #dialogFacebookShare {
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
    
    #dialogFacebookShare .blackout {
        width: 100%;
        height: 100%;
        background-color: black;
        -moz-opacity: 0.7;
        opacity:.70;
        filter: alpha(opacity=70);
    }
    
    #dialogFacebookShare .wrapper {
        position: absolute;
        top: 3%;
        left: 50%;
        width: 90%;
        background-color: #fff;
        transform: translate(-50%, 0%);
        -webkit-transform: translate(-50%, 0%);
        height: 90%;
        box-shadow: 0px 0px 8px #000000;
    }
    
    #dialogFacebookShare .wrapper iframe {
        width: 100%;
        height:  100%;
        border: 0px solid #000;
    }
    
    
    #dialogFacebookShare .dismiss {
        position: absolute;
        width:  30%;
        font-size:  0.62em;
        font-weight:  bold;
        text-align: center;
        color:  #666;
        background-color: #e70606;
        border: 1px solid #b10e0e;
        box-shadow: 0px 0px 8px #000000;
        bottom: 0.5%;
        left: 50%;
        padding: 2px;
        color: #fff;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        text-shadow: 1px 1px 2px #000;
    }
    
    
    
</style>

<div id="dialogFacebookShare">
    <div class="blackout"></div>
    <div class="wrapper" id="dialogFaceBookShareWrapper">
        <iframe src="http://www.meadleyson.com"></iframe>        
    </div>
    <div class="dismiss" id="dialogFacebookShareDimiss">Dismiss</div>
</div>

<script>
    
    document.getElementById('dialogFacebookShareDimiss').onclick = function () { dismissFacebookShare(); };

    function dismissFacebookShare() {
        document.getElementById('dialogFacebookShare').style.display = "none";
        
    };



</script>