<?php 

    // Gather countries
    global $connection;
    include_once('classes/DBConnection.php');

    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $database = mysqli_select_db($connection, DB_DATABASE);

    $query = "SELECT * from tblIngredient ORDER BY name ASC";
    $result = mysqli_query($connection, $query);

    $odd = FALSE;

?>

<div id="ingredientSelector">
    <div class="blackout"></div>
    <div class="wrapper" id="ingredientWrapper">
        <div id="ingredientselectortitle" class="title">Select Ingredients</div>
        <ul id="ingredientlist">
            <?php 

            if (!$result) {
                return NULL;
	        }
            else {
                $fullData = array();
	            while($row = mysqli_fetch_array($result) ){ 
                    $odd = !$odd;?>
                    <li class="<?php if($odd) echo "odd"; else echo "even";?>" title="<?php echo $row[0];?>" name="<?php echo $row[1];?>">
                        <div class="flag"><img id="check_<?php echo $row[0];?>"src="img/questions/rightMark.png" title="<?php echo $row[0];?>"  name="<?php echo $row[1];?>"/></div>
                        <div class="name" title="<?php echo $row[0];?>" name="<?php echo $row[1];?>"><?php echo $row[1];?></div>
                    </li>
                <?php }
           
            }
            ?>
            
        </ul>
    </div>
    <div class="closeWrapper">
        <img src="img/imgClose.png" id="ingredientsClose" alt="close" />
    </div>
</div>

<script>
    //var selectedCountry = "";
    //var selectedID = 0;

    var ingredientselector = document.getElementById("ingredientSelector");
    ingredientselector.style.display = "none";
    ingredientselector.style.height = window.innerHeight + 'px';

    var ingredientselectortitle = document.getElementById("ingredientselectortitle");

    var ingredientWrapper = document.getElementById("ingredientWrapper");

    var ingredientlist = document.getElementById("ingredientlist");

    

    var ingredientIDs = [];
    var ingredientNames = [];

    

    function getEventTarget(e) {
        e = e || window.event;
        return e.target || e.srcElement;
    }

    ingredientlist.onclick = function (event) {
        var target = getEventTarget(event);
        if (contains(ingredientIDs, target.title)) {
            document.getElementById("check_" + target.title).style.display = 'none';
            ingredientIDs = remove(ingredientIDs, target.title);
            ingredientNames = remove(ingredientNames, target.getAttribute('name'));

        }
        else {
            document.getElementById("check_" + target.title).style.display = 'block';
            ingredientIDs.push(target.title);
            ingredientNames.push(target.getAttribute('name'));
        }
        

        

    }

    function contains(a, obj) {
        var i = a.length;
        while (i--) {
            if (a[i] === obj) {
                return true;
            }
        }
        return false;
    }

    function remove(a, obj) {
        var i = a.length;
        while (i--) {
            if (a[i] === obj) {
                a.splice(i, 1);
            }
        }

        return a;
    }


</script>