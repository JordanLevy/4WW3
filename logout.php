<?php
session_start();
//clear session array
$_SESSION = array();
session_destroy();
//redirect
header("location: login.php");
exit;
?>