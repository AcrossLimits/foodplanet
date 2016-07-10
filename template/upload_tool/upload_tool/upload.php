<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    global $connection;
    include_once('classes/DBConnection.php');

    if((isset($_POST["title"]) && $_POST["title"]!="") && (isset($_POST["countryname"]) && $_POST["countryname"] != "")) {
        $title = $_POST["title"];

        

        $countryname = $_POST["countryname"];
        $countryid = $_POST["countryid"];

        $description = $_POST["description"];
        if($description == "")
            $description = "na";

        $recipe = $_POST["recipe"];
        if($recipe == "")
            $recipe = "na";

        $hint = $_POST["hint"];
        $provider = $_POST["provider"];

        echo "title: ".$title."\n";
        echo "countryname: ".$countryname."\n";
        echo "countryid: ".$countryid."\n";
        echo "description: ".$description."\n";
        echo "recipe: ".$recipe."\n";
        echo "hint: ".$hint."\n";
        echo "provider: ".$provider."\n";

        // If file was uploaded
        if($_FILES['imageUpload']['name']) {
        
            // If there were no errors in the file
            if(!$_FILES['imageUpload']['error']) {
                $date = new DateTime();    
                $filename = $date->format("YmdHis").".png";

                // Move the file to the server
                move_uploaded_file($_FILES['imageUpload']['tmp_name'], '../img/questions/'.$filename);
                



                // Update the database
                $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                $database = mysqli_select_db($connection, DB_DATABASE);

                // Insert question
                $query = "INSERT INTO tblQuestion (authorID, description, recipe, statusID, title, imgName) VALUES ('10153253101381858', '".$description."', '".$recipe."', 1, '".$title."', '".$filename."')";
                $result = mysqli_query($connection, $query);
                $resultID = mysqli_insert_id($connection);

                // Insert answer
                $query2 = "INSERT INTO tblQuestionAnswer (questionID, answerID) VALUES (".$resultID.", ".$countryid.")";
                $result2 = mysqli_query($connection, $query2);

                // Insert hint, if available
                if($hint != "") {
                    $query3 = "INSERT INTO tblQuestionHint (questionID, text) VALUES (".$resultID.", '".$hint."')";
                    $result3 = mysqli_query($connection, $query3);
                }

                // Insert provider, if available
                if($provider != "") {
                    $query4 = "INSERT INTO tblQuestionProvider (questionID, text) VALUES (".$resultID.", '".$provider."')";
                    $result4 = mysqli_query($connection, $query4);
                }

                header('Location: index.php?er=0');
            }

            // Otherwise return the error
            else {
                echo "File returned error: ".$_FILES['imageUpload']['error'];
                header('Location: index.php?er=1');
            }
        }
        else {
            echo "No File Uploaded!\n";
            header('Location: index.php?er=1');
        }

    }
    else {
         header('Location: index.php?er=2');
    }
    
    



?>
