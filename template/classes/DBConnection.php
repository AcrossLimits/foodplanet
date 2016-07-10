<?php
define('DB_SERVER', 'SERVER-ADDRESS');
define('DB_USERNAME', 'USERNAME');    // DB username
define('DB_PASSWORD', 'PASSWORD');    // DB password
define('DB_DATABASE', 'DATABASE NAME');      // DB name
$connection = "";
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
mysqli_set_charset($connection, "utf8");
if (mysqli_connect_error()) {
		echo  mysqli_connect_error();
	}
$database = mysqli_select_db($connection, DB_DATABASE) or die( "Unable to select database");
?>

