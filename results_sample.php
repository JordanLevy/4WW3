<?php

require_once "config.php";

	$searchLongitude = $_POST['searchLongitude'];
	$searchLatitude = $_POST['searchLatitude'];
	echo $searchLongitude . " " . $searchLatitude;
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
		<!-- link custom js file to populate Google Maps div -->
		<script src="js/maps.js"></script>
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
				<a class="navbar-brand" href="search.html">McMaster Restroom Finder</a>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<!-- navbar item -->
					<li class="nav-item">
						<!-- "Search Form" link in navbar -->
						<a class="nav-link" href="search.html">Search Form</a>
					</li>
					<li class="nav-item">
						<!-- "Object Submission Page" link in navbar -->
						<a class="nav-link" href="submission.html">Submit a Restroom</a>
					</li>
					<li class="nav-item">
						<!-- "User Registration Page" link in navbar -->
						<a class="nav-link" href="">Log In</a>
					</li>
					<li class="nav-item">
						<!-- "User Registration Page" link in navbar -->
						<a class="nav-link" href="registration.html">Register</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<!-- heading text -->
					<h3>Search Results</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-6" id="GoogleMap1Container">
					<!-- live map -->
					<div id="GoogleMap1"></div>
				</div>
  				<div class="col-6">
  					<div class="searchResults">
  						<!-- search results table -->
	  					<table class="table table-striped table-dark">
	  						<!-- table headers -->
							<thead>
								<tr>
									<th>Room #</th>
									<th>Rating</th>
									<th>Distance</th>
								</tr>
							</thead>
							<tbody>
								<!-- table row 1 -->
								<tr>
									<td><a href="individual_sample.html">BSB B134</a></td>
									<td>5</td>
									<td>0.3km</td>
								</tr>
								<!-- table row 2 -->
								<tr>
									<td><a href="individual_sample.html">ITB 123</a></td>
									<td>5</td>
									<td>2km</td>
								</tr>
								<!-- table row 3 -->
								<tr>
									<td><a href="individual_sample.html">MDCL 1101</a></td>
									<td>4</td>
									<td>2.1km</td>
								</tr>
							</tbody>
						</table>
					</div>
  				</div>
			</div>
		</div>
		<!-- footer -->
		<footer>
			<div class="row text-center">
				<!-- footer link to homepage -->
				<div class="col-md-4">
					<a href="search.html">McMaster Restroom Finder</a>
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
		<!-- link Google Maps API -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM8lbhIZ94WtCL8mPV0161-qIMTOr4Aus"></script>
	</body>
</html>