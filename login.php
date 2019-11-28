 <?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: welcome.php");
	exit;
}
 
// Include config file
require_once "config.php";

$username = $password = "";
$isError=false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST['submit'])){
		echo "1";
		if(empty(trim($_POST["username"]))){
			$isError=true;
			echo "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}

		if(empty(trim($_POST["password"]))){
			$isError=true;
			echo "Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}

		//credentials
		if(!$isError){
			// Prepare a select statement
			$sql = "SELECT id, username, password FROM users WHERE username = ?";
			
			if($stmt = sqlsrv_prepare($link, $sql)){
				echo "2";
				// Bind variables to the prepared statement as parameters
				sqlsrv_stmt_bind_param($stmt, "s", $param_username);
				echo "3";
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if(sqlsrv_stmt_execute($stmt)){
					echo "4";
					// Store result
					sqlsrv_stmt_store_result($stmt);
					// Check if username exists, if yes then verify password
					if(sqlsrv_stmt_num_rows($stmt) == 1){                    
						// Bind result variables
						sqlsrv_stmt_bind_result($stmt, $id, $username, $hashed_password);
						if(sqlsrv_stmt_fetch($stmt)){
							if(password_verify($password, $hashed_password)){
								// Password is correct, so start a new session
								session_start();
							
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username; 
								// Redirect user to welcome page
								header("location: welcome.php");
							} else{
								echo "The password you entered was not valid.";
							}
						}
					} else{
						echo "No account found with that username.";
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
		
			// Close statement
			sqlsrv_stmt_close($stmt);
		}

		// Close connection
		sqlsrv_close($link);
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
			<form method="POST" action="#">
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
							<button type="submit" value="Login" class="btn btn-primary">Log In</button>
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