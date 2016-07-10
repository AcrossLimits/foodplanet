test

<?php
    
    echo "Start\n";
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    global $connection;
    include_once('classes/DBConnection.php');

    if(((isset($_POST["title"]) && $_POST["title"]!="") && (isset($_POST["countryid"]) && $_POST["countryid"] != 0)) || (isset($_POST["europeanaLink"]))) {
        

        if(isset($_POST["title"]) && $_POST["title"]!="") {
            echo "Info entered";
            $title = $_POST["title"];
        $countryid = $_POST["countryid"];
        $uid = $_POST["uid"];

        $description = $_POST["description"];
        if($description == "")
            $description = "na";

        $recipe = "na";
        $hint = "na";
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
                    move_uploaded_file($_FILES['imageUpload']['tmp_name'], 'img/questions/'.$filename);
                
                    // Update the database
                    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                    $database = mysqli_select_db($connection, DB_DATABASE);

                    // Insert question
                    $query = "INSERT INTO tblQuestion (authorID, description, recipe, statusID, title, imgName) VALUES ('".$uid."', '".$description."', '".$recipe."', 2, '".$title."', '".$filename."')";
                    $result = mysqli_query($connection, $query);
                    $resultID = mysqli_insert_id($connection);

                    // Insert answer
                    $query2 = "INSERT INTO tblQuestionAnswer (questionID, answerID) VALUES (".$resultID.", ".$countryid.")";
                    $result2 = mysqli_query($connection, $query2);

                    // Insert hint, if available
                    ///if($hint != "") {
                        //$query3 = "INSERT INTO tblQuestionHint (questionID, text) VALUES (".$resultID.", '".$hint."')";
                        //$result3 = mysqli_query($connection, $query3);
                    //}

                    // Insert provider, if available
                    if($provider != "") {
                        $query4 = "INSERT INTO tblQuestionProvider (questionID, text) VALUES (".$resultID.", '".$provider." (Player)')";
                        $result4 = mysqli_query($connection, $query4);
                    }

                    header('Location: page.php#uploadSuccess');
                }

                // Otherwise return the error
                else {
                    echo "File returned error: ".$_FILES['imageUpload']['error'];
                    header('Location: page.php#uploadFailed');
                }
            }
        }
        else {
            echo "Europeana Link entered";
            $europeanaLink = $_POST["europeanaLink"];
            echo $europeanaLink;
            
            // Update the database
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            $database = mysqli_select_db($connection, DB_DATABASE);

            // Insert question
            $query = "INSERT INTO tblQuestion (statusID) VALUES (5);";
            $result = mysqli_query($connection, $query);
            $resultID = mysqli_insert_id($connection);

            // Insert answer
            $query2 = "INSERT INTO tblQuestionEuropeana (link, questionID) VALUES ('".$europeanaLink."', ".$resultID.")";
            $result2 = mysqli_query($connection, $query2);

        

            header('Location: page.php#uploadSuccess');
            
        }
    }
    else {
        echo "No info entered";
        header('Location: page.php#uploadFailed');
    }
    /*
    
    if((isset($_POST["title"]) && $_POST["title"]!="") && (isset($_POST["countryid"]) && $_POST["countryid"] != 0)) {
        echo "Entered item information";
        /*
        $title = $_POST["title"];
        $countryid = $_POST["countryid"];
        $uid = $_POST["uid"];

        $description = $_POST["description"];
        if($description == "")
            $description = "na";

        $recipe = "na";
        $hint = "na";
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
                move_uploaded_file($_FILES['imageUpload']['tmp_name'], 'img/questions/'.$filename);
                



                // Update the database
                $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                $database = mysqli_select_db($connection, DB_DATABASE);

                // Insert question
                $query = "INSERT INTO tblQuestion (authorID, description, recipe, statusID, title, imgName) VALUES ('".$uid."', '".$description."', '".$recipe."', 2, '".$title."', '".$filename."')";
                $result = mysqli_query($connection, $query);
                $resultID = mysqli_insert_id($connection);

                // Insert answer
                $query2 = "INSERT INTO tblQuestionAnswer (questionID, answerID) VALUES (".$resultID.", ".$countryid.")";
                $result2 = mysqli_query($connection, $query2);

                // Insert hint, if available
                ///if($hint != "") {
                    //$query3 = "INSERT INTO tblQuestionHint (questionID, text) VALUES (".$resultID.", '".$hint."')";
                    //$result3 = mysqli_query($connection, $query3);
                //}

                // Insert provider, if available
                if($provider != "") {
                    $query4 = "INSERT INTO tblQuestionProvider (questionID, text) VALUES (".$resultID.", '".$provider." (Player)')";
                    $result4 = mysqli_query($connection, $query4);
                }

                header('Location: page.php#uploadSuccess');
            }

            // Otherwise return the error
            else {
                echo "File returned error: ".$_FILES['imageUpload']['error'];
                header('Location: page.php#uploadFailed');
            }
        }
        else {
            echo "No File Uploaded!\n";
            header('Location: page.php#uploadFailed');
        }
        *//*
    }
    elseif (isset($_POST["europeanaLink"])) {
        echo "Entered Europeana Link";
        /*
        $europeanaLink = $_POST["europeanaLink"];
        echo $europeanaLink;

        // Update the database
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE);

        // Insert question
        $query = "INSERT INTO tblQuestion (statusID) VALUES (5);";
        $result = mysqli_query($connection, $query);
        $resultID = mysqli_insert_id($connection);

        // Insert answer
        $query2 = "INSERT INTO tblQuestionEuropeana (link, questionID) VALUES ('".$europeanaLink."', ".$resultID.")";
        $result2 = mysqli_query($connection, $query2);

        

        header('Location: page.php#uploadSuccess');



        
        *//*
    }
    else {
        echo "Failed";
         //header('Location: page.php#uploadFailed');
    }
    */
?>