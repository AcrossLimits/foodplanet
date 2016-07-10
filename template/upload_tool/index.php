<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    global $connection;
    require_once("classes/Question.php");
    include_once('classes/DBConnection.php');
    $question = new Question;
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $database = mysqli_select_db($connection, DB_DATABASE);

    $query = "SELECT * from tblAnswer ORDER BY text ASC";
    $result = mysqli_query($connection, $query);

    $error = -1;
    if(isset($_GET["er"])) {
        $error = $_GET["er"];
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Food Planet - Upload Tool</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="formtitle">Food Planet Upload Tool</div>
        <div id="uploadform">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="title">Photo</div>
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="imageUpload" id="imageUpload" />

                <div class="title">Title*</div>
                <input type="text" name="title" class="textbox" style="width: 240px;"><br>

                <div class="title">Description</div>
                <textarea class="textbox" name="description" id="description" cols="32" rows="4"></textarea><br>

                <div class="title">Recipe</div>
                <textarea class="textbox" name="recipe" id="recipe" cols="32" rows="4"></textarea><br>

                <div class="title">Provided by</div>
                <input type="text" name="provider" class="textbox" style="width: 240px;" placeholder="ex. John Doe's Restaurant (Malta)"><br>    

                <div class="title">Hint</div>
                <input type="text" name="hint" class="textbox" style="width: 240px;" placeholder="ex. This country is also known for wine"><br>

                <input type="hidden" name="countryname" id="country_hidden">                 
                <div class="title">Country*</div>                
                <select style="width: 244px;" name="countryid" onchange="getText(this)">
                    <option value="0">Select Country</option>
                <?php 

                if (!$result) {
                    return NULL;
	            }
                else {
                    $fullData = array();
	                while($row = mysqli_fetch_array($result) ){ 
                        ?>
                <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                    <?php }
           
                }
                ?>
                    </select><br>
                <div class="title">Europeana Link</div>
                <input type="text" name="europeana" class="textbox" style="width: 240px;" placeholder=""><br>

                <input class="button" type="submit" value="Upload" />
            </form>

            <div class="message">
            <?php 
                if($error >= 0) {
                    if($error==0)
                        echo "Uploaded successfully";
                    else if($error==1)
                        echo "Upload Photo failed";
                    else if($error==2)
                        echo "Required fields left empty";
                    else
                        echo "";                
                }                                    
            ?>
        </div>
        </div>
        <script>
            function getText(element) {
                var elt = element;

                if (elt.selectedIndex == -1)
                    return null;

                document.getElementById("country_hidden").value = elt.options[elt.selectedIndex].text;
            }
        </script>
    </body>
</html>
