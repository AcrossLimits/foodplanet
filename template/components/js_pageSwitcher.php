<script type="text/javascript">
    var isGuest = false;
    <?php 
        if($uid == "Guest")
            echo "isGuest = true;";
    ?>
</script>
    <script type="text/javascript">
        // Main page features
        var page_title = document.getElementById("pageTitle");
        var home_icon = document.getElementById("homeIcon");
        var home_icon_icon = document.getElementById("homeIcon_Icon");
        var menu_button = document.getElementById("menuButton");
        var page_content = document.getElementById("pageContent");

        // Gather all pages
        var page_dashboard = document.getElementById("page_dashboard");
        var page_badges = document.getElementById("page_badges");
        var page_leaderboard = document.getElementById("page_leaderboard");
        var page_catalog = document.getElementById("page_catalog");
        var page_about = document.getElementById("page_about");
        var page_upload = document.getElementById("page_upload");
        var page_uploadSuccess = document.getElementById("page_uploadSuccess");
        var page_uploadFailed = document.getElementById("page_uploadFailed");
        var page_verify = document.getElementById("page_verify");
        var page_europeana = document.getElementById("page_europeana");

        // Gather page titles
        var title_home = document.getElementById("pageTitleHome").innerHTML;
        var title_badges = document.getElementById("pageTitleBadges").innerHTML;
        var title_leaderboard = document.getElementById("pageTitleLeaderboard").innerHTML;
        var title_catalog = document.getElementById("pageTitleCatalog").innerHTML;
        var title_about = document.getElementById("pageTitleAbout").innerHTML;

        // Store current page
        var current = page_dashboard;
        changePage();

        // Handle page changes
        window.onhashchange = changePage;
        function changePage() {

            var hash = window.location.hash;
            var nonguest = false;
            var pagetitletext = '';
            current.style.display = 'none';


            switch (hash) {
                case "#dashboard":
                    {
                        nonguest = false;
                        pagetitletext = title_home;
                        current = page_dashboard;
                        break;
                    }
                case "#badges":
                    {
                        nonguest = true;
                        pagetitletext = title_badges;
                        current = page_badges;
                        break;
                    }
                case "#leaderboard":
                    {
                        nonguest = false;
                        pagetitletext = title_leaderboard;
                        current = page_leaderboard;
                        break;
                    }
                case "#catalog":
                    {
                        nonguest = true;
                        pagetitletext = title_catalog;
                        current = page_catalog;
                        break;
                    }
                case "#about":
                    {
                        nonguest = false;
                        pagetitletext = title_about;
                        current = page_about;
                        break;
                    }
                case "#upload":
                    {
                        nonguest = true;
                        current = page_upload;
                        break;
                    }
                case "#uploadSuccess":
                    {
                        nonguest = true;
                        current = page_uploadSuccess;
                        break;
                    }
                case "#uploadFailed":
                    {
                        nonguest = true;
                        current = page_uploadFailed;
                        break;
                    }
                case "#verify":
                    {
                        nonguest = true;
                        current = page_verify;
                        break;
                    }
                case "#europeana":
                    {
                        nonguest = true;
                        current = page_europeana;
                        break;
                    }
                default:
                    {
                        nonguest = false;
                        current = page_dashboard;
                        break;
                    }
            }

            document.body.style.backgroundColor = '' + current.getAttribute("data");
            page_title.innerHTML = pagetitletext;
            current.style.display = 'block';
            current.style.top = (header.clientHeight) + 'px';

            if (hash == "#dashboard") {
                document.getElementById('page_dashboard').style.height = (window.innerHeight - (document.getElementById('header').clientHeight)) + 'px';

            }

            else if (hash == "#leaderboard") {
                document.getElementById('leaderTable1').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
                document.getElementById('leaderTable2').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
                document.getElementById('leaderTable3').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
                document.getElementById('leaderTable4').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('leaderMenu').clientHeight + document.getElementById('leaderTime').clientHeight + 0)) + 'px';
            }

            else if (hash == "#catalog") {
                document.getElementById('catalogTable1').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('catalogMenu').clientHeight)) + 'px';
                document.getElementById('catalogTable2').style.height = (window.innerHeight - (document.getElementById('header').clientHeight + document.getElementById('catalogMenu').clientHeight)) + 'px';
                document.getElementById('moreInfo').style.display = 'none';
            }

            else if (hash == "#badges") {
                var height = (document.getElementById('badgesMenu').clientHeight + document.getElementById('header').clientHeight);
                badges_geographical.style.height = (window.innerHeight - height) + 'px';
                badges_challenge.style.height = (window.innerHeight - height) + 'px';
                badges_upload.style.height = (window.innerHeight - height) + 'px';
            }

            else if (hash == "#verify") {
                var height = (document.getElementById('header').clientHeight);
                verfiy_content.style.height = (window.innerHeight - height) + 'px';
            }
            else if (hash == "#europeana") {
                var height = (document.getElementById('header').clientHeight);
                europeana_content.style.height = (window.innerHeight - height) + 'px';
            }

            else if (hash == "#upload") {
                page_upload.style.height = (window.innerHeight - header.clientHeight) + 'px';
            }

            else if (hash == "#uploadSuccess") {
                page_uploadSuccess.style.height = (window.innerHeight - header.clientHeight) + 'px';
                ga('send', 'event', 'button', 'submission', 'Successful Submission');
            }

            else if (hash == "#uploadFailed") {
                page_uploadFailed.style.height = (window.innerHeight - header.clientHeight) + 'px';
                ga('send', 'event', 'button', 'submission', 'Failed Submission');
            }

            ga('send', 'pageview', {
                'page': location.pathname + location.search + location.hash
            });


        };

        function pressBack() {
            var hash = window.location.hash;
            if (hash == "#dashboard") {
                // do nothing
            }
            else {
                window.location = "#dashboard";
            }
        };
    </script>