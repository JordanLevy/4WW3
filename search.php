<?php

require_once "config.php";

$searchLongitude = $searchLatitude = "";


if(isset($_POST['searchLongitude']) and isset($_POST['searchLatitude'])){
	//get input from fields
	$searchLongitude = $_POST['searchLongitude'];
	$searchLatitude = $_POST['searchLatitude'];

	echo $searchLongitude . " " . $searchLatitude;
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
						<input class="form-control" type="text" placeholder="Search" aria-label="Search">
						<input class="form-control" type="text" id="searchLongitude" hidden>
						<input class="form-control" type="text" id="searchLatitude" hidden>
					</label>
				</div>
				<!-- "Rating" section -->
				<div class="col-sm-4">
					<!-- Rating stars selector -->
					<label class="inputLabel">Rating:
						<div class="rating">
							<input type="radio" name="star" id="star1"><label for="star1">
							</label>
							<input type="radio" name="star" id="star2"><label for="star2">
							</label>
							<input type="radio" name="star" id="star3"><label for="star3">
							</label>
							<input type="radio" name="star" id="star4"><label for="star4">
							</label>
							<input type="radio" name="star" id="star5"><label for="star5">
							</label>
						</div>
					</label>
				</div>
				<div class="col-sm-4">
					<!-- "Washroom gender" section -->
					<label class="inputLabel">Looking for a(n):
						<!-- "Men's washroom" checkbox -->
						<div class="men">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="men">
								<label class="form-check-label men" for="men">
									Men's washroom
								</label>
							</div>
						</div>
						<!-- "Women's washroom" checkbox -->
						<div class="women">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="women">
								<label class="form-check-label women" for="women">
									Women's washroom
								</label>
							</div>
						</div>
						<!-- "All Genders washroom" checkbox -->
						<div class="allGenders">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="allGenders">
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
				<div class="col-md-6">
					<div class="search">
						<button type="button" class="btn btn-primary btn-block" onclick="getLocation('results_sample.php')">Search by Location</button>
					</div>
				</div>
				<div class="col-md-6">
					<div class="search">
						<button type="button" class="btn btn-primary btn-block" onclick="window.location.href='results_sample.php'">Search by Criteria</button>
					</div>
				</div>
			</div>
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