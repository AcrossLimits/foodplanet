<?php
    
    global $connection;
    include_once('classes/DBConnection.php');


 $itemID = 0;
 $itemName = '';
 $itemImage = '';
 $itemDescription = '';
 $itemProvider = '';
 $itemEuropeana = '';
 if(isset($_GET["itemID"])) {
     $itemID = $_GET["itemID"];
 }

 if($itemID == 0) {
     echo "failed";
 }
 else {
     $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
     $database = mysqli_select_db($connection, DB_DATABASE);
     $query = "SELECT A.title, A.imgName, A.description FROM tblQuestion A WHERE A.id=$itemID;";
    $result = mysqli_query($connection, $query);
    //var_dump($result);

    if (!$result) {

	    }
    else {
        while($row = mysqli_fetch_array($result) ){
            $itemName=$row[0];
            $itemImage = $row[1];
            $itemDescription = $row[2];
        }
    }

    $query = "SELECT A.text   FROM tblQuestionProvider A WHERE A.questionID=$itemID;";
    $result = mysqli_query($connection, $query);
    //var_dump($result);

    if (!$result) {
            $itemProvider = 'Unknown';
	    }
    else {
        while($row = mysqli_fetch_array($result) ){
            $itemProvider=$row[0];
        }
    }

    $query = "SELECT A.link FROM tblQuestionEuropeana A WHERE A.questionID=$itemID;";
    $result = mysqli_query($connection, $query);
    //var_dump($result);

    if (!$result) {
            $itemEuropeana = '';
	    }
    else {
        while($row = mysqli_fetch_array($result) ){
            $itemEuropeana=$row[0];
        }
    }


    // Echo output
    echo $itemName."##".$itemImage."##".$itemDescription."##".$itemProvider."##".$itemEuropeana;
 }

?>
