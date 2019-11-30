<?php

require_once "config.php";

$menCheckbox = $womenCheckbox = $allGendersCheckbox = $star = $searchTerms = "";
$isError = false;

if(isset($_POST['submit'])){
	//get input from fields
	$menCheckbox = $_POST['menCheckbox'];
	$womenCheckbox = $_POST['womenCheckbox'];
	$allGendersCheckbox = $_POST['allGendersCheckbox'];
	$star = $_POST['star'];
	$searchTerms = $_POST['searchTerms'];

	echo $menCheckbox . "</br>";
	echo $star;

	/*//check username
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
		$query = "SELECT id, username, password FROM users WHERE username='" . $username . "'";
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
		       echo "Incorrect username or password";
		}else{
			//get the query results
		    while($row = sqlsrv_fetch_array($result)){
		    	//if the password is correct
		    	if(password_verify($password, $row['password']))
		    	{
		    		//start the session
		    		session_start();
		       		$_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["username"] = $username;
                    //redirect
                    header("location:welcome.php");
		   		} else {
		   			echo "Incorrect username or password";
		   		}
		    }
		}
	}*/
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
		<title>McMaster Restroom Finder</title>
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
					<li class="nav-item active">
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
					<li class="nav-item">
						<!-- "User Registration Page" link in navbar -->
						<a class="nav-link" href="registration.php">Register</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="wrapper container">
			<form action="#" method="post">
				<!-- bootstrap row -->
				<div class="row">
					<!-- bootstrap column of width 12 -->
					<div class="col-md-12">
						<!-- header text -->
						<h3>McMaster Restroom Finder</h3>
					</div>
				</div>
				<div class="row">
					<!-- "Building name" search bar button -->
					<div class="col-sm-4">
						<!-- "Building name" search bar -->
						<label class="inputLabel">Building name:
							<input class="form-control" type="text" name="searchTerms" placeholder="Search" aria-label="Search">
						</label>
					</div>
					<!-- "Rating" section -->
					<div class="col-sm-4">
						<!-- Rating stars selector -->
						<label class="inputLabel">Rating:
							<select name="star">
								<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
								<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
								<option value="3">&#9733;&#9733;&#9733;</option>
								<option value="2">&#9733;&#9733;</option>
								<option value="1">&#9733;</option>
							</select>
						</label>
					</div>
					<div class="col-sm-4">
						<!-- "Washroom gender" section -->
						<label class="inputLabel">Looking for a(n):
							<!-- "Men's washroom" checkbox -->
							<div class="men">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="men" name="menCheckbox">
									<label class="form-check-label men" for="men">
										Men's washroom
									</label>
								</div>
							</div>
							<!-- "Women's washroom" checkbox -->
							<div class="women">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="women" name="womenCheckbox">
									<label class="form-check-label women" for="women">
										Women's washroom
									</label>
								</div>
							</div>
							<!-- "All Genders washroom" checkbox -->
							<div class="allGenders">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="allGenders" name="allGendersCheckbox">
									<label class="form-check-label allGenders" for="allGenders">
										All Genders washroom
									</label>
								</div>
							</div>
						</label>
					</div>
				</div>
				<div class="row">
					<!-- Search button -->
					<div class="col-md-12">
						<div class="search">
							<button type="submit" name="submit" class="btn btn-primary btn-block">Search</button>
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
		<!-- link custom js file to use geolocation -->
		<script src="js/geo.js"></script>
	</body>
</html>