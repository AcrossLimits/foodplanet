<script>
    // 1 - Points Week
    // 2 - Points All Time
    // 3 - Challenges Week
    // 4 - Challenges All Time
    var leaderboardState = 1;

    var btnLeaderPoints = document.getElementById("leaderboardPoints");
    var btnLeaderChallenge = document.getElementById("leaderboardChallenges");
    var btnLeaderWeek = document.getElementById("leaderboardWeek");
    var btnLeaderAllTime = document.getElementById("leaderboardAllTime");

    var leaderTable_pointsweek = document.getElementById('leaderboard_pointsweek');
    var leaderTable_pointsalltime = document.getElementById('leaderboard_pointsalltime');
    var leaderTable_challengesweek = document.getElementById('leaderboard_challengesweek');
    var leaderTable_challengesalltime = document.getElementById('leaderboard_challengesalltime');
    var currentTable = leaderTable_pointsweek;

    document.getElementById('leaderTable1').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
    document.getElementById('leaderTable2').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
    document.getElementById('leaderTable3').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
    document.getElementById('leaderTable4').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
    console.log($('.playerPhotoWrapper').css("Width"));
    
    btnLeaderPoints.onclick = function () {
        if (leaderboardState != 1 && leaderboardState != 2) {
            if (leaderboardState == 3)
                SwitchLeaderboard(1);
            else
                SwitchLeaderboard(2);
        }
    }

    btnLeaderChallenge.onclick = function () {
        if (leaderboardState != 3 && leaderboardState != 4) {
            if (leaderboardState == 1)
                SwitchLeaderboard(3);
            else
                SwitchLeaderboard(4);
        }
    }

    btnLeaderWeek.onclick = function () {
        if (leaderboardState != 1 && leaderboardState != 3) {
            if (leaderboardState == 2)
                SwitchLeaderboard(1);
            else
                SwitchLeaderboard(3);
        }
    }

    btnLeaderAllTime.onclick = function () {
        if (leaderboardState != 2 && leaderboardState != 4) {
            if (leaderboardState == 1)
                SwitchLeaderboard(2);
            else
                SwitchLeaderboard(4);
        }
    }

    function SwitchLeaderboard(state) {
        currentTable.style.display = 'none';
        if (state == 1 || state == 2) {
            btnLeaderPoints.className = 'selected';
            btnLeaderChallenge.className = '';
        }
        else {
            btnLeaderChallenge.className = 'selected';
            btnLeaderPoints.className = '';
        }

        if (state == 1 || state == 3) {
            btnLeaderWeek.className = 'selected';
            btnLeaderAllTime.className = '';
        }

        else {
            btnLeaderWeek.className = '';
            btnLeaderAllTime.className = 'selected';
        }

        if (state == 1)
            currentTable = leaderTable_pointsweek;
        else if (state == 2)
            currentTable = leaderTable_pointsalltime;
        else if (state == 3)
            currentTable = leaderTable_challengesweek;
        else
            currentTable = leaderTable_challengesalltime;

        // finally
        currentTable.style.display = 'block';
        var size = $('.playerPhotoWrapper').css('padding-bottom');
        $('.leaderPhoto').height(size);
        $('.leaderPhoto').width(size);
        leaderboardState = state;
    }

    SwitchLeaderboard(1);


</script>