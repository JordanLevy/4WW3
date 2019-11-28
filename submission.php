<?php

require_once "config.php";

$building = $roomNum = $longitude = $latitude = $description = "";
$isError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST['submit'])){

		$building=$_POST['building'];
		$roomNum=$_POST['roomNum'];
		$longitude=$_POST['longitude'];
		$latitude=$_POST['latitude'];
		$description=$_POST['description'];

		//check building
		if(empty($building)){
			$isError=true;
			echo '<span style="color:red;">A building is required</span><br/>';
		}

		//check room number
		if(empty($roomNum)){
			$isError=true;
			echo '<span style="color:red;">A room number is required</span><br/>';
		} else {
			if(!preg_match('[A-Za-z0-9]+', $roomNum)) {
				$isError=true;
				echo '<span style="color:red;">Room number: any length, can contain only numbers and letters</span><br/>';
			}
		}

		//check longitude
		if(empty($longitude)){
			$isError=true;
			echo '<span style="color:red;">A longitude is required</span><br/>';
		}

		//check latitude
		if(empty($latitude)){
			$isError=true;
			echo '<span style="color:red;">A latitude is required</span><br/>';
		}

		//check description
		if(empty($description)){
			$isError=true;
			echo '<span style="color:red;">A description is required</span><br/>';
		}

		if(!$isError) {
			$params = array($building, $roomNum, $longitude, $latitude, $description);
			$query="INSERT INTO objects (building, roomNum, longitude, latitude, description) VALUES (?, ?, ?, ?, ?)";
			$result = sqlsrv_query($conn, $query, $params);
			if( $result === false ) {
				echo "ERROR<br>";
				$errors=sqlsrv_errors();
				echo "<br>";
				print_r($errors);
				echo "<br>";
			    die();
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
		<title>Submit a New Location</title>
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
					<li class="nav-item active">
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
			<div class="row">
				<div class="col-md-12">
					<!-- heading text -->
					<h3>Submit a New Location</h3>
				</div>
			</div>
			<form action="#" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<!-- "Building" textbox -->
							<input type="text" class="form-control" id="building" name="building" placeholder="Building" required>
						</div>
						<div class="row">
							<!-- "Room #" textbox -->
							<input type="text" class="form-control" id="roomNum" name="roomNum" placeholder="Room #" pattern="[A-Za-z0-9]+" required>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<!-- "Longitude" textbox -->
									<input type="number" class="form-control" id="longitude" name="longitude" step="any" min="-180" max="180" placeholder="Longitude" required>
								</div>
								<div class="row">
									<!-- "Latitude" textbox -->
									<input type="number" class="form-control" id="latitude" name="latitude" step="any" min="-90" max="90" placeholder="Latitude" required>
								</div>
							</div>
							<div class="col-md-4">
								<!-- "Use Current Location" button -->
								<button type="button" id="currentLocBtn" class="btn btn-secondary" onclick="getLocation('None')">Use Current Location</button>
							</div>
						</div>
						<div class="row">
							<!-- "Description" textarea -->
							<textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
						</div>
						<div class="row">
							<!-- "Submit" button -->
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					<div class="col-md-6">
						<label>Upload an Image:</label>
						<input class="btn btn-secondary" type="file"/>
						<img id="myImg" src="#" style="display:none" height="80%" width="80%">
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
		<!-- link custom js file to upload image -->
		<script src="js/upImg.js"></script>
	</body>
</html>