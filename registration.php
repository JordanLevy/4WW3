<?php

require_once "config.php";

$username = $password = $confirmPassword = $email = $dateOfBirth = "";
$isError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST['submit'])){

		$username=$_POST['username'];
		$password=$_POST['password'];
		$confirmPassword=$_POST['confirmPassword'];
		$email=$_POST['email'];
		$dateOfBirth=$_POST['dateOfBirth'];
		$notifications=0;

		//check username
		if(empty($username)){
			$isError=true;
			echo '<span style="color:red;">A username is required</span><br/>';
		} else {
			if(!preg_match('/^[A-Za-z0-9!@#$%&*_.]{6,30}$/', $username)) {
				$isError=true;
				echo '<span style="color:red;">Username: length at least 6, length at most 30, contains only letters, numbers, and special characters</span><br/>';
			}
		}
		//check password
		if(empty($password)){
			$isError=true;
			echo '<span style="color:red;">A password is required</span><br/>';
		} else {
			if(!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/', $password)) {
				$isError=true;
				echo '<span style="color:red;">Password: length at least 8, contains at least one digit, lowercase, uppercase, and special character</span><br/>';
			}
		}
		//check confirmPassword
		if(empty($confirmPassword)){
			$isError=true;
			echo '<span style="color:red;">A password confirmation is required</span><br/>';
		} else {
			if($password != $confirmPassword) {
				$isError=true;
				echo '<span style="color:red;">Password confirmation must match password</span><br/>';
			}
		}
		//check email
		if(empty($email)){
			$isError=true;
			echo '<span style="color:red;">An email is required</span><br/>';
		} else {
			if(!preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/', $email)) {
				$isError=true;
				echo '<span style="color:red;">Email must be of the form __@__.com</span><br/>';
			}
		}
		$password=password_hash($password, PASSWORD_BCRYPT);
	
		if(isset($_POST['notifications'])){
			$notifications=1;
		}

		echo $username . "<br/>";
		echo $password . "<br/>";
		echo $email . "<br/>";
		echo $dateOfBirth . "<br/>";
		echo $notifications . "<br/>";
		var_dump($isError);
		var_dump($conn);

		if(!$isError) {
			$params = array($username, $password);
			$query="INSERT INTO test (username, password) VALUES (?, ?)";
			$result = sqlsrv_query($conn, $query, $params);
			if( $result === false ) {
				echo "ERROR<br>";
				$errors=sqlsrv_errors();
				echo "<br>";
				print_r($errors);
				echo "<br>";
			    //die();
			}
		}

	}
}


// try to close the db connection at the end 
try {
	sqlsrv_close($conn);
} catch (Exception $e) {
	$code = $e->getCode();
	$msg = $e->getMessage();
	echo $code.": ".$error_message."<br />";

}

	// //include the config file
	// require_once "config.php";

	// if(isset($_POST['submit'])){
	// 	$username=$_POST['username'];
	// 	$password=$_POST['password'];
	// 	$confirmPassword=$_POST['confirmPassword'];
	// 	$email=$_POST['email'];
	// 	$dateOfBirth=$_POST['dateOfBirth'];
	// 	$termsOfService=0;
	// 	$notifications=0;
	// 	$isError=false;

	// 	if(isset($_POST['termsOfService'])){
	// 		$termsOfService=1;
	// 	}
	// 	if(isset($_POST['notifications'])){
	// 		$notifications=1;
	// 	}


	// 	//check username
	// 	if(empty($username)){
	// 		$isError=true;
	// 		echo '<span style="color:red;">A username is required</span><br/>';
	// 	} else {
	// 		if(!preg_match('/^[A-Za-z0-9!@#$%&*_.]{6,30}$/', $username)) {
	// 			$isError=true;
	// 			echo '<span style="color:red;">Username: length at least 6, length at most 30, contains only letters, numbers, and special characters</span><br/>';
	// 		}
	// 	}
	// 	//check password
	// 	if(empty($password)){
	// 		$isError=true;
	// 		echo '<span style="color:red;">A password is required</span><br/>';
	// 	} else {
	// 		if(!preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/', $password)) {
	// 			$isError=true;
	// 			echo '<span style="color:red;">Password: length at least 8, contains at least one digit, lowercase, uppercase, and special character</span><br/>';
	// 		}
	// 	}
	// 	//check confirmPassword
	// 	if(empty($confirmPassword)){
	// 		$isError=true;
	// 		echo '<span style="color:red;">A password confirmation is required</span><br/>';
	// 	} else {
	// 		if($password != $confirmPassword) {
	// 			$isError=true;
	// 			echo '<span style="color:red;">Password confirmation must match password</span><br/>';
	// 		}
	// 	}
	// 	//check email
	// 	if(empty($email)){
	// 		$isError=true;
	// 		echo '<span style="color:red;">An email is required</span><br/>';
	// 	} else {
	// 		if(!preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/', $email)) {
	// 			$isError=true;
	// 			echo '<span style="color:red;">Email must be of the form __@__.com</span><br/>';
	// 		}
	// 	}

	// 	if($termsOfService!=1){
	// 		$isError=true;
	// 		echo '<span style="color:red;">You must agree to the Terms of Service</span><br/>';
	// 	}

	// 	$password=password_hash($password, PASSWORD_BCRYPT);

	// 	if(!$isError) {
	// 		$query="INSERT INTO users (username, password, email, dateOfBirth, notifications) VALUES ('$username', '$password', '$email', '$dateOfBirth', '$notifications')";
	// 		if(!mysqli_query($link, $query)){
	// 			echo mysqli_error($link);
	// 		}
	// 	}
	// }
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
		<title>Register an Account</title>
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
					<li class="nav-item">
						<!-- "User Registration Page" link in navbar -->
						<a class="nav-link" href="login.php">Log In</a>
					</li>
					<li class="nav-item active">
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
					<h3>Register an Account</h3>
				</div>
			</div>
			<form method="POST" action="#">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<!-- "Username" textbox -->
							<input type="text" class="form-control formValReg" name="username" id="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
						</div>
						<div class="row">
							<!-- "Password" textbox -->
							<input type="password" class="form-control formValReg" name="password" id="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
						</div>
						<div class="row">
							<!-- "Confirm Password" textbox -->
							<input type="password" class="form-control formValReg" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password"value="<?php echo isset($_POST['confirmPassword']) ? htmlspecialchars($_POST['confirmPassword']) : '' ?>">
						</div>
						<div class="row">
							<!-- "Email" textbox -->
							<input type="email" class="form-control formValReg" name="email" id="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
						</div>
						<div class="row">
							<label for="example-date-input" class="col-2 col-form-label">Date of Birth:</label>
							<div class="col-10">
								<!-- "Date of Birth" date selector -->
								<input class="form-control formValReg" type="date" value="2011-08-19" name="dateOfBirth" id="dateOfBirth" value="<?php echo isset($_POST['dateOfBirth']) ? htmlspecialchars($_POST['dateOfBirth']) : '' ?>">
							</div>
						</div>
						<div class="row">
							<!-- "Terms of Service" checkbox -->
							<input type="checkbox" class="form-check-input" name="termsOfService" id="termsOfService">
							<label class="form-check-label" for="termsOfService">I agree to the <a href="">Terms of Service</a></label>
						</div>
						<div class="row">
							<!-- "I would like to receive email notifications" checkbox -->
							<input type="checkbox" class="form-check-input" name="notifications" id="notifications">
							<label class="form-check-label" for="notifications">I would like to receive email notifications</label>
						</div>
						<div class="row">
							<!-- "Submit" button -->
							<button type="submit" name="submit" class="btn btn-primary">Register</button>
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