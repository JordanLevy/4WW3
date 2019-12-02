<?php

session_start();

//include config to connect to database
require_once "config.php";

$title = $gender = $avgRating = $description = '';
$reviewStar = $reviewText = '';
$isError = false;

//if the id we got from the url isn't a number, give an error
if(!is_numeric($_GET['id'])){
	$isError=true;
	echo '<span style="color:red;">Invalid url</span><br/>';
}

if(!$isError){
	//search for this bathroom in database by its id
	$params = array($_GET['id']);
	$query = "SELECT id, building, roomNum, longitude, latitude, description, numReviews, rating, gender FROM objects WHERE id=?";
	$result = sqlsrv_query($conn, $query, $params);
	//if the search didn't work
	if( $result === false ) {
		echo "ERROR<br>";
		$errors=sqlsrv_errors();
		echo "<br>";
		print_r($errors);
		echo "<br>";
		die();
	}
	//if the query returned nothing
	if(sqlsrv_has_rows($result) != 1){
		   echo "Nothing returned from search";
	}else{
		$mapData = array();
		//get the query results
		while($row = sqlsrv_fetch_array($result)){
			$title = $row['building'] . " " . $row['roomNum'];
			$gender = $row['gender'];
			$description = $row['description'];

			//add places to the map
			array_push($mapData, array(
			"placeName" => $row['building'] . " " . $row['roomNum'],
			"LatLng" => array(array(
					"lat" => $row['latitude'],
					"lng" => $row['longitude'],
				))
			));	
		}
	}
	$mapData_s = json_encode($mapData);

	//search for reviews in database
	$params = array($_GET['id']);
	$query = "SELECT users.username, reviews.rating, reviews.description, reviews.created_at FROM reviews INNER JOIN users ON users.id = reviews.userID WHERE reviews.objectID=?";
	$result = sqlsrv_query($conn, $query, $params);
	//if the search didn't work
	if( $result === false ) {
		echo "ERROR<br>";
		$errors=sqlsrv_errors();
		echo "<br>";
		print_r($errors);
		echo "<br>";
		die();
	}
	$i = 0;
	//if there are no reviews
	if(sqlsrv_has_rows($result) != 1){
	}else{
		//get the query results
		while($row = sqlsrv_fetch_array($result)){
			$starString = '';
			for ($x = 0; $x < $row['rating']; $x++) {
    			$starString .= " &#9733;";
			}
			//append the html code for a review to the variable
			$reviewHTML .= '<div class="row">
				<div class="col-md-12">
					<label for="desc' . $i . '">' . $row['username'] . $starString . ' ' . $row['created_at']->format('Y-m-d h:i A') . '</label>
    					<textarea class="form-control" id="desc' . $i . '" rows="3" disabled>' . $row['description'] . '</textarea>
						</div>
					</div>';
			$i++;
		}
	}

	//calculate the average rating
	$params = array($_GET['id']);
	$query = "SELECT avg(Cast(rating as Float)) FROM reviews WHERE objectID=?";
	$result = sqlsrv_query($conn, $query, $params);
	//if the search didn't work
	if( $result === false ) {
		echo "ERROR<br>";
		$errors=sqlsrv_errors();
		echo "<br>";
		print_r($errors);
		echo "<br>";
		die();
	}
	//if the query returned nothing
	if(sqlsrv_has_rows($result) != 1){
		   echo "Rating could not be retrieved";
	}else{
		//get the query results
		while($row = sqlsrv_fetch_array($result)){
			$avgRating = $row[0];
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
		<title>McMaster Restroom Finder</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<script>
			console.log("hellooo!!!!");
			var mapData = <?php echo $mapData_s; ?>;
			console.log("map data is: ",  mapData);

			//map object
			var map;
			//list of marker info tags
			var markerInfo = [];
			//coordinates to center the map at
			var centerCoords = {
				lat: 43.2609,
				lng: -79.9192
			};
			var markers = mapData;
			console.log("markers: ", markers);

			//when the page loads, initialize the map
			window.onload = function () {
				initMap();
			};

			//add the info tags for each marker
			function addMarkerInfo() {
				for (var i = 0; i < markers.length; i++) {
					var contentString = '<div id="content" style="background: #2f2f2f;"><h4>' + markers[i].placeName + '</h4></div>';

					const marker = new google.maps.Marker({
						position: markers[i].LatLng[0],
						map: map
					});

					const infowindow = new google.maps.InfoWindow({
						content: contentString,
						maxWidth: 200
					});

					marker.addListener('click', function () {
						closeOtherInfo();
						infowindow.open(marker.get('map'), marker);
						markerInfo[0] = infowindow;
					});
				}
			}

			//close all other tags
			function closeOtherInfo() {
				if (markerInfo.length > 0) {
					markerInfo[0].set("marker", null);
					markerInfo[0].close();
					markerInfo.length = 0;
				}
			}

			//initialize the map
			function initMap() {
				map = new google.maps.Map(document.getElementById('GoogleMap1'), {
					zoom: 15,
					center: centerCoords
				});
				addMarkerInfo();
			}
		</script>

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
					<h3><?php echo $title; ?></h3>
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
							<p class="<?php if($gender=='M'){ echo 'men'; }else if($gender=='F'){ echo 'women'; }else{ echo 'allGenders'; } ?>"><?php if($gender=='M'){ echo "Men's washroom"; }else if($gender=='F'){ echo "Women's washroom"; }else{ echo "All Genders washroom"; } ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- object description text -->
    						<textarea class="form-control" rows="3" disabled><?php echo $description; ?></textarea>
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
							<label>Average Rating: <?php echo round($avgRating, 1); ?> stars</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- "Reviews" subheading text -->
					<h3>Reviews</h3>

					<?php echo $reviewHTML; ?>

					<div class="row">
						<div class="col-md-4">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal">
								Write a Review
							</button>
							<div class="modal fade" id="mymodal">
								<div class="modal-dialog">
									<div class="modal-content">
										<?php
											//if the user is logged in, show the UI to write a review. Otherwise, ask them to sign in.
											if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
												echo '
												<form action="#" method="post" id="review_form">
													<div class="modal-header" style="background: #262626;">
														<h3>Write a Review of ' . $title . '</h3>
													</div>
													<div class="modal-body" style="background: #262626;">
															<!-- Rating stars selector -->
															<label class="inputLabel">Rating:
																<select name="reviewStar">
																	<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
																	<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
																	<option value="3" selected="selected">&#9733;&#9733;&#9733;</option>
																	<option value="2">&#9733;&#9733;</option>
																	<option value="1">&#9733;</option>
																</select>
															</label>
															<textarea class="form-control" type="text" name="reviewText" placeholder="Type your review here..."></textarea>
													</div>
													<div class="modal-footer" style="background: #262626;">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-primary" name="submit" id="submitForm" data-dismiss="modal">Submit</button>
													</div>
											</form>';
											} else{
												echo '<div class="modal-header" style="background: #262626;">
														<h3>Write a Review of ' . $title . '</h3>
													</div>
													<div class="modal-body" style="background: #262626;">
														<p>You must be <a href=\'login.php\'>logged in</a> to write a review.</p>
													</div>
													<div class="modal-footer" style="background: #262626;">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
													</div>';
											}

										?>-->
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
						</div>
					</div>
				</div>
			</div>
		</div>

		<script>
		/* must apply only after HTML has loaded */
		$(document).ready(function () {
		    $("#review_form").on("submit", function(e) {
		        var postData = $(this).serializeArray();
		        var formURL = $(this).attr("action");

		        console.log("postData", postData);
		        console.log("formURL", formURL);


		        // append this bathroom's id into postData array
		        var bathroomId = "<?php echo $_GET['id']; ?>";

				postData.push({
				    name:   "bathroomId",
				    value: bathroomId
				});

		        console.log("postData", postData);

		        $.ajax({
		            url: "/submit_review.php",
		            type: "POST",
		            data: postData,
		            success: function(data, textStatus, jqXHR) {
		            	console.log("data returned is: " + data);
		            	console.log("textStatus is: " + textStatus);
		            	console.log("jqXHR is: " + jqXHR);
		            	alert("Your review has been submitted.");
		            },
		            error: function(jqXHR, status, error) {
		                console.log(status + ": " + error);
		            }
		        });
		       e.preventDefault();
		    });
		     
		    $("#submitForm").on('click', function() {
		        $("#review_form").submit();
		    });
		});
		</script>

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
		<script src="<?php echo getenv("mapsAPIKey"); ?>"></script>
	</body>
</html>