<div id="catalog_AZ" style="display: none;">
    <div class="leaderTableWrapper fade-in one">
                        <table class="leaderTable" id="catalogTable1" cellspacing="0" cellpadding="0">
                            <?php 
                                $type = "even";
                                $count = 0;
                                foreach($catalog_AZ as $cat) :
                                $count++;
                                if($type == "even")
                                    $type = "odd";
                                else
                                    $type = "even";

                            ?>
                            <tr class="<?php echo $type; ?>" id="itemAZ_<?php echo $cat->itemID; ?>">
                                <td class="left">
                                
                                    <div class="playerPhotoWrapper">
                                        <div class="playerLeft">
                                            <img src="<?php echo "../img/questions/".$cat->imageURL;?>" alt="" class="leaderPhoto"/>
                                        </div>
                                    </div>
                                
                                </td>
                                <td class="middle">
                                    <div class="playerDetails">
                                        <div class="playerName"><?php echo $cat->itemName;?></div>
                                        <div class="playerStats">
                                            <img src="<?php echo "../img/flags/".$cat->flagURL;?>" />
                                            <span class="value"><?php echo $cat->countryName;?></span>                                       
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