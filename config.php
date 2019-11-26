<?php
//define the sql login credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', '4WW3');
 
//try to connect to sql database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
//if we couldn't connect, stop
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>