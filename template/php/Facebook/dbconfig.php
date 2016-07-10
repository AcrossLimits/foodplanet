<?php
define('DB_SERVER', 'SERVER-ADDRESS');
define('DB_USERNAME', 'USERNAME');    // DB username
define('DB_PASSWORD', 'PASSWORD');    // DB password
define('DB_DATABASE', 'DATABASE NAME');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
?>