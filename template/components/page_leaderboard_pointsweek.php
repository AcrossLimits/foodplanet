<div id="leaderboard_pointsweek">
    <div class="leaderTableWrapper fade-in one">
                        <table class="leaderTable" id="leaderTable1" cellspacing="0" cellpadding="0">
                            <?php 
                                $type = "even";
                                $count = 0;
                                foreach($leaders_pointsweek as $leader) :
                                $count++;
                                if($type == "even")
                                    $type = "odd";
                                else
                                    $type = "even";

                            ?>
                            <tr class="<?php echo $type; if($leader->playerID == $user->id) echo " user"; ?>">
                                <td class="left">
                                
                                    <div class="playerPhotoWrapper">

                                            <img src="<?php echo $user->getImageURL($leader->playerID); ?>" alt=""  class="leaderPhoto" />
                                            <div class="rank"><?php echo $count; ?></div>

                                    </div>
                                
                                </td>
                                <td class="middle">
                                    <div class="playerDetails">
                                        <div class="playerName"><?php echo $leader->name." ".$leader->surname; ?></div>
                                        <div class="playerStats">
                                            <img src="img/imgMedal.png" />
                                            <span class="value"><?php echo $leader->wins; ?></span>
                                            <img src="img/imgBadge.png" />
                                            <span class="value"><?php echo $leader->badges; ?></span>
                                            <img src="img/imgPoints.png" />
                                            <span class="value"><?php echo $leader->points; ?></span>
                                        
                                        </div>
                                    </div>
                                </td>
                                <td class="right">
                            
                                </td>
                            
                            </tr>
                            <?php endforeach; ?>
                            
                    </table>
                    </div>
</div>