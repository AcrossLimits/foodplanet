<div id="menuWrapper">
        <div id="menuOverlay"></div>
        <div id="menuLeft"></div>
        <div id="menuRight">
            <div class="wrapper">
                <div class="playerDetails">
                    <table>
                        <tr>
                            <td class="photo">
                                <div class="photoWrapper">
                                    <img src="<?php echo $user->pictureURL;?>" alt="Player Photo" />
                                </div>
                            </td>
                            <td class="spacer">
                            </td>
                            <td class="details">
                                <div class="wrapper">
                                        <div class="playerName"><?php echo $user->getFullName();?></div>
                                        <?php if($user->id != 1) {?>
                                        <div class="playerDetails">
                                            <div class="stat">
                                                <div class="icon"><img src="../img/imgMedal.png" /></div>
                                                <div class="value"><?php echo $user->getWins($user->id);?></div>
                                            </div>
                                            <div class="stat">
                                                <div class="icon"><img src="../img/imgBadge.png" /></div>
                                                <div class="value"><?php echo $user->getBadges($user->id);?></div>
                                            </div>
                                            <div class="stat">
                                                <div class="icon"><img src="../img/imgPoints.png" /></div>
                                                <div class="value"><?php echo $user->getPoints($user->id);?></div>
                                            </div>
                                        </div>
                                        <?php }?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
       
                <div class="menuLinks">
                    <div class="link" id="btnHome">
                        <div class="icon"><img src="../img/icons/iconHome.jpg" alt="Home" /></div>
                        <div class="text" data-localize="_navigation._home">Home</div>
                    </div>
                    <div class="link" id="btnBadges">
                        <div class="icon"><img src="../img/icons/iconBadges.jpg" alt="Badges" /></div>
                        <div class="text" data-localize="_home._badges">Badges</div>
                    </div>
                    <div class="link" id="btnLeaderboard">
                        <div class="icon"><img src="../img/icons/iconLeaderboard.jpg" alt="Leaderboard" /></div>
                        <div class="text" data-localize="_navigation._leaderboard">Leaderboard</div>
                    </div>
                    <div class="link" id="btnCatalog">
                        <div class="icon"><img src="../img/icons/iconCatalog.png" alt="Catalog" /></div>
                        <div class="text" data-localize="_navigation._catalog">Catalog</div>
                    </div>
                    <div class="link" id="btnAbout">
                        <div class="icon"><img src="../img/icons/iconAbout.jpg" alt="About" /></div>
                        <div class="text" data-localize="_navigation._about">About</div>
                    </div>
                    <div class="link" id="btnSettings" style="display: none;">
                        <div class="icon"><img src="../img/icons/iconSettings.jpg" alt="Settings" /></div>
                        <div class="text">Settings</div>
                    </div>
                    <div class="link" id="btnEditProfile" style="display: none;">
                        <div class="icon"><img src="../img/icons/iconProfile.jpg" alt="Profile" /></div>
                        <div class="text">Edit Profile</div>
                    </div>
                    <div class="link" id="btnLogout">
                        <div class="icon"><img src="../img/icons/iconLogout.jpg" alt="Logout" /></div>
                        <div class="text" data-localize="_navigation._logout">Log Out</div>
                    </div>
                    <?php if($user->statusID == 2) {?>
                    <div class="link admin" id="btnVerify">
                        <div class="icon"><img src="../img/icons/iconReview.png" alt="Verify" /></div>
                        <div class="text" data-localize="_navigation._verify">Verify Uploaded Meals</div>
                    </div>
                    <? }?>
                    <div class="link europeana" id="btnEuropeana">
                        <div class="icon"><img src="../img/icon_europeana_small.png" alt="Europeana" /></div>
                        <div class="text"><img src="../img/europeana_text.png" alt="Europeana" /></div>
                    </div>
                </div>
            </div>
        </div>
    </div>