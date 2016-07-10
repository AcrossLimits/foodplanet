<?php 
    if($opponent->id != NULL)
        $totalPlayers = 2;
    else {
        $totalPlayers = 1;
    }
?>

<div id="challenge_start" class="page" data="#bbe5fa" name="Start Challenge">
    <div id="challengeStartUpper">
        <table class="challengePlayersWrapper">
            <tr>
                <td>
                    <div class="playerWrapper" id="player1Wrapper">
                        <div class="playerPhoto"><img src="<?php echo $user->pictureURL;?>" class="playerChallengePhoto"/></div>
                    </div>
                    <div class="playerName"><?php echo $user->name." ".$user->surname;?></div>
                    <?php if($uid!="Guest") {?>
                    <div class="playerCountry"><img src="<?php echo $user->getFlagURL();?>" /><?php echo $user->country;?></div>
                    <?php }?>
                    <div class="playerRank <?php echo $user->getRank();?>"><?php echo $user->getRank();?></div>
                </td>
                
                <?php if($totalPlayers == 2) {?>      
                <td id="challengeStartUpperSpacer">
                    <div></div>
                </td>      
                <td>
                    <div class="playerWrapper" id="player2Wrapper">
                        <div class="playerPhoto"><img src="<?php echo $opponent->pictureURL;?>" class="playerChallengePhoto"/></div>
                    </div>
                    <div class="playerName"><?php echo $opponent->name." ".$opponent->surname;?></div>
                    <div class="playerCountry"><img src="<?php echo $opponent->getFlagURL();?>" /><?php echo $opponent->country;?></div>
                    <div class="playerRank <?php echo $opponent->getRank();?>"><?php echo $opponent->getRank();?></div>
                </td>
                <?php }?>
            </tr>
        </table>
        
    </div>

    <div id="challengeStartMiddle">
        <div class="title"  data-localize="_challenge._howto">How To Play</div>
        <div class="rule"  data-localize="_challenge._selectWhere">- Select where you think the food is from</div>
        <div class="rule"  data-localize="_challenge._fasterAnswer">- The faster you answer, the more points you get</div>
        <div class="rule"  data-localize="_challenge._somequestions">- Some questions may have more than one answer</div>
    </div>

    <div id="challengeStartLower">
        <div class="startMessage"  data-localize="_challenge._challengeStart">Challenge Starts In</div>
        <div class="startCounter" id="startCounter">6</div>
    </div>

</div>