<script>
    //var size = $('.playerPhoto').css('padding-bottom');
        //$('.playerChallengePhoto').height(size);
        //$('.playerChallengePhoto').width(size);
</script>

<script type="text/javascript">
    var challengeStartUpper = document.getElementById("challengeStartUpper");
    var player1wrapper = document.getElementById("player1Wrapper");
    var player2wrapper = document.getElementById("player2Wrapper");
    var challengeStartUpperSpacer = document.getElementById("challengeStartUpperSpacer");
    var startCounter = document.getElementById("startCounter");


    challengeStartUpper.style.height = (window.innerHeight / 4.2) + 'px';
    player1wrapper.style.width = (challengeStartUpper.clientHeight - (challengeStartUpper.clientHeight * 0.5)) + 'px';
    //player1wrapper.style.height = player1wrapper.clientWidth + 'px';

    <?php if($opponent->id != NULL) { ?> 
    player2wrapper.style.width = player1wrapper.clientWidth + 'px';
     challengeStartUpperSpacer.style.width = (challengeStartUpper.clientWidth * 0.1) + 'px';
    <?php }?>
    //player2wrapper.style.height = player1wrapper.clientWidth + 'px';
   

    var seconds;
              var temp;
 
              function countdown() {
                seconds = startCounter.innerHTML;
                seconds = parseInt(seconds, 10);
 
                if (seconds == 1) {
                  window.location="#play";
                  
                  return;
                }
 
                seconds--;
                startCounter.innerHTML = seconds;
                timeoutMyOswego = setTimeout(countdown, 1000);
              } 
 
                countdown();

</script>