<?php

//start session
session_start();

//if the user is already logged in, redirect them
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location:welcome.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$isError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST['login'])){
		//get input from fields
		$username = $_POST['username'];
		$password = $_POST['password'];


		//check username
		if(empty($username)){
			$isError=true;
			echo '<span style="color:red;">A username is required</span><br/>';
		}
		//check password
		if(empty($password)){
			$isError=true;
			echo '<span style="color:red;">A password is required</span><br/>';
		}

		if(!$isError) {
			//search for user in database
			$query = "SELECT id, username, password FROM users WHERE username='Jordan'";
			echo $query;
			$result = sqlsrv_query($conn, $query);
			//if the search didn't work
			if( $result === false ) {
				echo "ERROR<br>";
				$errors=sqlsrv_errors();
				echo "<br>";
				print_r($errors);
				echo "<br>";
			    die();
			}

			//if it's zero rows
			if(sqlsrv_has_rows($result) != 1){
			       echo "No rows<br/>";
			}else{
				#creates sessions
			    while($row = sqlsrv_fetch_array($result)){
			    	if(password_verify($password, $row['password']))
			    	{
			    		echo $row['password'] . "<br/>";
			    		session_start();
			       		$_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $row['id'];
                        $_SESSION["username"] = $username;
                        echo $_SESSION["id"] . "<br/>";
                        header("location:welcome.php");
			   		} else {
			   			echo "Incorrect username or password";
			   		}
			    }
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<!-- set charset -->
		<meta charset="UTF-8">
		<!-- link bootstrap css -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- link custom css file -->
		<link rel="stylesheet" href="css/index.css">
		<!-- set page title -->
		<title>Log In</title>
	</head>
	<body>
		<!-- navbar header -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navHeader" aria-controls="navHeader" aria-expanded="false" aria-label="Toggle navigation">
				<!-- navbar collapse icon -->
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navHeader">
				<!-- navbar brand that links to homepage -->
				<a class="navbar-brand" href="search.php">McMaster Restroom Finder</a>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<!-- navbar item -->
					<li class="nav-item">
						<!-- "Search Form" link in navbar -->
						<a class="nav-link" href="search.php">Search Form</a>
					</li>
					<li class="nav-item">
						<!-- "Object Submission Page" link in navbar -->
						<a class="nav-link" href="submission.php">Submit a Restroom</a>
					</li>
					<li class="nav-item active">
						<!-- "User Registration Page" link in navbar -->
						<a class="nav-link" href="">Log In</a>
					</li>
					<li class="nav-item">
						<!-- "User Registration Page" link in navbar -->
						<a class="nav-link" href="registration.php">Register</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="wrapper container">
			<div class="row">
				<div class="col-md-12">
					<!-- header text -->
					<h3>Log In</h3>
				</div>
			</div>
			<form action="#" method="post">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<!-- "Username" textbox -->
							<input type="text" class="form-control formValReg" id="username" name="username" placeholder="Username">
						</div>
						<div class="row">
							<!-- "Password" textbox -->
							<input type="password" class="form-control formValReg" id="password" name="password" placeholder="Password">
						</div>
						<div class="row">
							<!-- "Submit" button -->
							<button type="submit" name="login" class="btn btn-primary">Log In</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- footer -->
		<footer>
			<div class="row text-center">
				<!-- footer link to homepage -->
				<div class="col-md-4">
					<a href="search.php">McMaster Restroom Finder</a>
				</div>
				<!-- footer copyright -->
				<div class="col-md-4">
					<p>Copyright &copy; 2019 McMaster Restroom Finder</p>
				</div>
				<!-- footer links -->
				<div class="col-md-4">
					<div class="row">
						<!-- footer link to "FAQ" -->
						<div class="col-md-12">
							<a href="#">FAQ</a>
						</div>
						<!-- footer link to "About Us" -->
						<div class="col-md-12">
							<a href="#">About Us</a>
						</div>
						<!-- footer link to "Contact" -->
						<div class="col-md-12">
							<a href="#">Contact</a>
						</div>
						<!-- footer link to "Report a bug" -->
						<div class="col-md-12">
							<a href="#">Report a bug</a>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- link jquery javascript so the collapsed navbar can toggle -->
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<!-- link bootstrap javascript -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>