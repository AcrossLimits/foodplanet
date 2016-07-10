<div id="page_leaderboard" class="page" data="#bbe5fa" name="Leaderboards">
    <table class="leaderMenu" id="leaderMenu">
        <tr>
            <td class="selected" id="leaderboardPoints" data-localize="_leaderboard._points">Points earned</a></td>
            <td class="" id="leaderboardChallenges" data-localize="_leaderboard._challenges">Challenges won</td>
        </tr>
    </table>
    
    <?php 
        include_once("components/page_leaderboard_pointsweek.php");
        include_once("components/page_leaderboard_pointsalltime.php");
        include_once("components/page_leaderboard_challengesweek.php");
        include_once("components/page_leaderboard_challengesalltime.php");
        
    ?>

    <div class="leaderboardLower" id="leaderTime">
                        
            <table>
                <tr>
                    <td class="selected" id="leaderboardWeek"  data-localize="_leaderboard._week">This Week</a></td>
                    <td class="" id="leaderboardAllTime"  data-localize="_leaderboard._allTime">All Time</a></td>
                </tr>
            </table>            
        </div>  

</div>                    
                