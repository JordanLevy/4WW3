<?php

session_start();

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

	//set values so they can be passed to the url
	if(isset($menCheckbox)){
		$menCheckbox=1;
	}else{
		$menCheckbox=0;
	}

	if(isset($womenCheckbox)){
		$womenCheckbox=1;
	}else{
		$womenCheckbox=0;
	}

	if(isset($allGendersCheckbox)){
		$allGendersCheckbox=1;
	}else{
		$allGendersCheckbox=0;
	}

	//if there were no validation errors
    if(!$isError){
    	//redirect with parameters in url
    	//header("location:results_sample.php?terms=" . $searchTerms . "&rating=" . $star . "&men=" . $menCheckbox . "&women=" . $womenCheckbox . "&allGenders=" . $allGendersCheckbox );
    	$searchUrl = "results_sample.php?terms=" . $searchTerms . "&rating=" . $star . "&men=" . $menCheckbox . "&women=" . $womenCheckbox . "&allGenders=" . $allGendersCheckbox;
    	echo "<script type='text/javascript'>


dest=\"\";

//gets the longitude and latitude of the device
function getLocation(d) {
	console.log(d);
	dest=d;
	if (navigator.geolocation) {
		if(d == 'None') {
			navigator.geolocation.getCurrentPosition(setLatLongCoords, currLocError);
		}
		else {
				navigator.geolocation.getCurrentPosition(byLoc, searchError);
		}
	} else {
		document.location = dest + \"&long=na&lat=na\";
	}
}

//display the location and redirect to dest
function byLoc(position) {
	//document.getElementById('searchLatitude').value = position.coords.latitude
	//document.getElementById('searchLongitude').value = position.coords.longitude;
	document.location = dest + \"&long=\" + position.coords.longitude + \"&lat=\" + position.coords.latitude;
}

//sets the latitude and longitude text boxes
function setLatLongCoords(position) {
	document.getElementById('latitude').value = position.coords.latitude
	document.getElementById('longitude').value = position.coords.longitude;
}

//show an error on the search page
function searchError() {
	alert(\"Unable to search using location. Please allow the site to know your location, or try to search by criteria instead.\");
}

//show an error on the submission page
function currLocError() {
	alert(\"Unable to retrieve current location. Please allow the site to know your location, or enter your coordinates manually instead.\")
}


    	getLocation('$searchUrl');
    	</script>";
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
						<a class="nav-link" href="<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){ echo 'logout.php'; }else{ echo 'login.php'; } ?>"><?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){ echo 'Log Out'; }else{ echo 'Log In'; } ?></a>
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
							<input class="form-control" type="text" name="searchTerms" placeholder="e.g. BSB B134" aria-label="Search">
						</label>
					</div>
					<!-- "Rating" section -->
					<div class="col-sm-4">
						<!-- Rating stars selector -->
						<label class="inputLabel">Rating:
							<select name="star">
								<option value="0">-----</option>
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
	</body>
</html>