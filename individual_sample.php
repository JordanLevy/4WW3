<?php

session_start();

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
			<!-- bootstrap row -->
			<div class="row">
				<!-- bootstrap column of width 12 -->
				<div class="col-md-12">
					<!-- header text -->
					<h3>BSB B134</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12" id="GoogleMap1Container">
							<!-- live map -->
							<div id="GoogleMap1"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<!-- washroom gender text -->
							<p class="women">Women's washroom</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- object description text -->
    						<textarea class="form-control" rows="3" disabled>This bathroom has 4 stalls and 2 sinks, as well as 1 paper towel dispenser and 2 soap dispensers.</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- "Ratings" subheading text -->
							<h3>Ratings</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- average rating -->
							<label>Average Rating: 4.3 stars</label>
						</div>
					</div>
					<!-- ratings bar graph -->
					<!-- 5 star -->
					<div class="row">
						<div class="col-md-3">
							<!-- 5 star label -->
							<label>5 star</label>
						</div>
						<div class="col-md-9">
							<label>
								<!-- 5 star bar -->
								<svg width="150" height="20">
										<rect x="0" y="0" rx="5" ry="5" width="150" height="20"
										style="fill:#03fc39;opacity:0.7" />
								</svg>
								150
							</label>
						</div>
					</div>
					<!-- 4 star -->
					<div class="row">
						<div class="col-md-3">
							<!-- 4 star label -->
							<label>4 star</label>
						</div>
						<div class="col-md-9">
							<label>
								<!-- 4 star bar  -->
								<svg width="150" height="20">
										<rect x="0" y="0" rx="5" ry="5" width="100" height="20"
										style="fill:#0345fc;opacity:0.7" />
								</svg>
								100
							</label>
						</div>
					</div>
					<!-- 3 star -->
					<div class="row">
						<div class="col-md-3">
							<!-- 3 star label -->
							<label>3 star</label>
						</div>
						<div class="col-md-9">
							<label>
								<!-- 3 star bar -->
								<svg width="150" height="20">
										<rect x="0" y="0" rx="5" ry="5" width="30" height="20"
										style="fill:#03fcfc;opacity:0.7" />
								</svg>
								30
							</label>
						</div>
					</div>
					<!-- 2 star -->
					<div class="row">
						<div class="col-md-3">
							<!-- 2 star label -->
							<label>2 star</label>
						</div>
						<div class="col-md-9">
							<label>
								<!-- 2 star bar -->
								<svg width="150" height="20">
										<rect x="0" y="0" rx="5" ry="5" width="15" height="20"
										style="fill:#fca903;opacity:0.7" />
								</svg>
								15
							</label>
						</div>
					</div>
					<!-- 1 star -->
					<div class="row">
						<div class="col-md-3">
							<!-- 1 star label -->
							<label>1 star</label>
						</div>
						<div class="col-md-9">
							<label>
								<!-- 1 star bar -->
								<svg width="150" height="20">
										<rect x="0" y="0" rx="5" ry="5" width="2" height="20"
										style="fill:#fc0303;opacity:0.7" />
								</svg>
								2
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<img src="BSB_B134.png" alt="Bathroom door" width="60%" class="objImg">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- "Reviews" subheading text -->
					<h3>Reviews</h3>

					<!-- individual review -->
					<div class="row">
						<div class="col-md-12">
							<!-- username and rating -->
							<label for="desc1">abc123 &#9733; &#9733; &#9733; &#9733; &#9733;</label>
							<!-- review text -->
    						<textarea class="form-control" id="desc1" rows="3" disabled>This bathroom is my go-to! Nice soap dispensers, clean, and it's easy to get to between classes.</textarea>
						</div>
					</div>
					<!-- individual review -->
					<div class="row">
						<div class="col-md-12">
							<!-- username and rating -->
							<label for="desc2">iop342 &#9733; &#9733;</label>
							<!-- review text -->
    						<textarea class="form-control" id="desc2" rows="3" disabled>Smells great, but it's always crowded. The lock on my stall was broken.</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="moreReviews">
								<!-- "See More Reviews" button -->
								<button type="button" class="btn btn-primary btn-block">See More Reviews</button>
							</div>
						</div>
						<div class="col-md-8">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="writeReview">
								<!-- "Write a Review" button -->
								<button type="button" class="btn btn-primary btn-block">Write a Review</button>
							</div>
						</div>
						<div class="col-md-8">
						</div>
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
		<!-- link Google Maps API -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM8lbhIZ94WtCL8mPV0161-qIMTOr4Aus"></script>
		<!-- link custom js file to populate Google Maps div -->
		<script src="js/mapsInd.js"></script>
	</body>
</html>