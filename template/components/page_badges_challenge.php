<div id="badges_challenge" class="badgeTable">
    <?php 
        $badges = $challenge_badges;
        $specialOpen = FALSE;
        $count = 0;
    ?>

    <?php
        foreach($badges as $b) {    
                
            // Set up the badge info
            $imgURL = $borderColor = $backgroundColor = "";

            if(in_array($b->id, $userBadges)) {
                $imgURL = $b->imgURL;
                $borderColor = $b->borderColor;
                $backgroundColor = $b->bgColor;
            }
            else {
                $id = intval($b->id);
                if($id < 10) $id = "0".$id;
                $imgURL = "img/badges/".$id."_locked.png";
                $borderColor = "#595858";
                $backgroundColor = "#7c7b7b";
            }

            if($count >= $BADGES_PER_ROW) {
                echo "</tr><tr>";
                $count = 0;
            }

            // If the badge is special
            if($b->special == 1) {
            
                // If we havent created the special table yet
                if(!$specialOpen) {
                    $specialOpen = TRUE;
                    // Create the table
                    echo "<table class='badgesTableSpecial fade-in one'><tr>";
                }
            }

            // If the badge isnt special but the special table is still open, close it
            if($b->special != 1 && $specialOpen) {
                $specialOpen = FALSE;
                $count = 0;
                echo "</tr></table>";
                echo "<table class='badgeTable fade-in one' style='background-color: #bbe5fa;'><tr>";
            }

            // Output the badge ?>
        
            <td>
                <div class="badgeWrapper">
                    <div class="badgeIcon" id="badge_<?php echo $b->id; ?>">
                        <img src="<?php echo $imgURL?>" style="background-color: <?php echo $backgroundColor; ?>; border: <?php if($b->special == 1) echo "3px"; else echo "2px";?> solid <?php echo $borderColor; ?>;"/>
                    </div>
                    <div class="badgeName <?php if(!in_array($b->id, $userBadges)) echo "locked";?>" style="color: <?php echo $borderColor; ?>;"><?php echo $b->name; ?></div>
                    <div class="badgeValue" style="color: <?php echo $borderColor; ?>;"><?php echo $b->value; ?></div>
                </div>
                
            </td>

            <?php // Increment counter
            $count++;
        }
    ?>

    </table>
    

    

</div>