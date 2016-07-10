<?php 

    // Gather countries
    global $connection;
    include_once('classes/DBConnection.php');

    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $database = mysqli_select_db($connection, DB_DATABASE);

    $query = "SELECT * from tblAnswer ORDER BY text ASC";
    $result = mysqli_query($connection, $query);

    $odd = FALSE;

?>

<div id="countrySelector">
    <div class="blackout"></div>
    <div class="wrapper" id="countryWrapper">
        <div id="countryselectortitle" class="title">Select Country</div>
        <ul id="countrylist">
            <?php 

            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){ 
                    $odd = !$odd;?>
                    <li class="<?php if($odd) echo "odd"; else echo "even";?>" title="<?php echo $row[1];?>" name="<?php echo $row[0];?>">
                        <div class="flag"><img src="img/answers/<?php echo strtolower($row[2]);?>" alt=""  title="<?php echo $row[1];?>" name="<?php echo $row[0];?>" /></div>
                        <div class="name" title="<?php echo $row[1];?>" name="<?php echo $row[0];?>"><?php echo $row[1];?></div>
                    </li>
                <?php }
           
            }
            ?>
            
        </ul>
    </div>
</div>

<script>
    var selectedCountry = "";
    var selectedID = 0;

    var countryselector = document.getElementById("countrySelector");
    countryselector.style.height = window.innerHeight + 'px';

    var countryselectortitle = document.getElementById("countryselectortitle");

    var countrywrapper = document.getElementById("countryWrapper");

    var countrylist = document.getElementById("countrylist");
    countrylist.style.height = (countrywrapper.clientHeight - countryselectortitle.clientHeight) + 'px';
    countryselector.style.display = "none";
   
</script>