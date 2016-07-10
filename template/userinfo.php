<?php 

    // Start session
    session_start();
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    include_once('classes/DBConnection.php');       
    include('classes/User.php');
    
    global $connection;
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $database = mysqli_select_db($connection, DB_DATABASE);

    
    


    // Create objects
    $user = new User;

    if ($_SESSION['FBID']) {
    $uid = $_SESSION['FBID'];
    if($uid != 'Guest') {

        $user = $user->getUser($uid, TRUE);
        $query = "SELECT * from tblCountry ORDER BY name ASC";
        $result = mysqli_query($connection, $query);
        $countries = array();

        // Challenge Header
        include_once("components/userinfo_header.php"); 
        
        

        // If the user has been banned, redirect them
        if($user->statusID == 3) {
            header("Location: banned.php");
        }

    }
    else {
        header("Location: page.php#dashboard");
    }

    }
    else
        header("Location: login.php");
    
?>

<div id="pageContent">
    <div id="page_userinfo" class="page" data="#bbe5fa" name="Food Planet">
        <div class="upper">
            <div class="welcome">Hi <?php echo $user->name;?>!</div>  
            <div class="before">Welcome to Food Planet</div>   
        </div>
        <div class="country">
            <div class="title">Please select your country</div>  
            <select id="countrySelect">
                <option value="0">Select Country</option>
                <?php 

                if (!$result) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){ 
                        $countries[] = $row[1];
                        ?>
                <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                    <?php }
           
                }
                ?>
            </select>
        </div>

        <div class="dob">
            <div class="title">Please enter your date of birth</div>  
            <table class="dobtable">
                <tr>
                    <td class="day">
                        <select id="dateSelect">
                            <?php 
                                for($i = 1; $i<=31; $i++) {
                                    if($i < 10)
                                        $date = "0".$i;
                                    else
                                        $date = $i;
                                    echo "<option value='".$i."'>".$date."</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td class="month"><select id="monthSelect">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select></td>
                    <td class="year"><select id="yearSelect"><?php for($i = 2015; $i>=1915; $i--) {echo "<option value='".$i."'>".$i."</option>";}?></select></td>
                </tr>
            </table>
        </div>

        <div class="button" id="btnStart">Start!</div>
        
    </div>                                    
</div>
        
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>  
    <script>

        var header = document.getElementById('header');
        var current = document.getElementById("page_userinfo");
        document.body.style.backgroundColor = '' + current.getAttribute("data");
        current.style.display = 'block';
        current.style.top = (header.clientHeight) + 'px';

        var start = document.getElementById('btnStart');
        start.onclick = function () {
            var countryID = document.getElementById("countrySelect").value;
            var date = document.getElementById("dateSelect").value;
            var month = document.getElementById("monthSelect").value;
            var year = document.getElementById("yearSelect").value;
            window.location = "userinfo_submit.php?cID="+countryID+"&d="+date+"&m="+month+"&y="+year;
        }

    </script>  
    <script src="js/fontScaler.js"></script> 
    <?php
        
        // Google Tracking
        //include_once('components/js_googleanalytics.php')


    ?>
    
    </body>
</html>
