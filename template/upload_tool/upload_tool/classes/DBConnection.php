<?php
define('DB_SERVER', '148.251.84.234');
define('DB_USERNAME', 'acrosslimits');    // DB username
define('DB_PASSWORD', 'wra8ap@EdE*');    // DB password
define('DB_DATABASE', 'fnd');      // DB name
$connection = "";
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_error()) {
		echo  mysqli_connect_error();
	}
$database = mysqli_select_db($connection, DB_DATABASE) or die( "Unable to select database");
?>
