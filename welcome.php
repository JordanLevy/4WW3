<?php

session_start();
 
//if the user is not logged in, redirect to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set charset -->
		<meta charset="UTF-8">
		<!-- link bootstrap css -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- link custom css file -->
		<link rel="stylesheet" href="css/index.css">
		<!-- set page title -->
		<title>Welcome</title>
</head>
<body>
	<div class="page-header">
		<h3 align="center">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to McMaster Restroom Finder.</h3>
	</div>
	<div class="row justify-content-center align-items-center">
		<a href="search.php" class="btn btn-primary">Continue to site</a>
		<a href="logout.php" class="btn btn-secondary">Sign Out</a>
	</div>
</body>
</html>