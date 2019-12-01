<?php

session_start();

require_once "config.php";

$tblID = array('', '', '');
$tblBuilding = array('', '', '');
$tblGender = array('', '', '');
$tblRating = array('', '', '');
$tblDistance = array('', '', '');
$isError = false;

//validate url params
if(!is_numeric($_GET['rating'])){
	$isError=true;
	echo '<span style="color:red;">Invalid url</span><br/>';
}

if(!$isError){
	$usingTerms = ($_GET['terms'] != '');
	$usingRating = ($_GET['rating'] != '0');
	$usingLocation = ($_GET['long'] != 'na' and $_GET['lat'] != 'na');
	$g = "";
	if($_GET['men']=='1'){
		$g .= "M";
	}
	if($_GET['women']=='1'){
		$g .= "F";
	}
	if($_GET['allGenders']=='1'){
		$g .= "A";
	}
	//search for user in database
	$params = array();
	$query = "SELECT id, building, roomNum, longitude, latitude, numReviews, rating, gender";
	//if we're using location, define a calculated column for distance from the current geolocation
	if($usingLocation){
		$query .= ", sqrt(square(?-longitude) + square(?-latitude)) as distance";
		array_push($params, $_GET['long'], $_GET['lat']);
	}
	$query .= " FROM objects WHERE ? like concat('%', gender, '%')";
	array_push($params, $g);
	if($usingTerms){
		$query .= " OR concat(building, ' ', roomNum) LIKE ?";
		array_push($params, "%" . $_GET['terms'] . "%");
		//if we're searching by terms and by rating, add an "or rating" operator in between the statements
	}
	if($usingRating){
		$query .= " OR floor(rating) = ?";
		array_push($params, $_GET['rating']);
	}
	//if we have distance from geolocation, order by it
	if($usingLocation){
		$query .= " ORDER BY distance";
	}
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
	$i=0;
	//if it's zero rows
	if(sqlsrv_has_rows($result) != 1){
		   echo "0 rows";
	}else{
		//get the query results
		while($row = sqlsrv_fetch_array($result)){
			$tblID[$i] = $row['id'];
			$tblBuilding[$i] = $row['building'] . " " . $row['roomNum'];

			if($row['gender']=='M'){
				$tblGender[$i] = "Men's";
			}else if($row['gender']=='F'){
				$tblGender[$i] = "Women's";
			}else{
				$tblGender[$i] = "All Genders";
			}

			$tblRating[$i] = $row['rating'];
			$tblDistance[$i] = $row['distance'];

			$i++;
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
									<th>Building/Room #</th>
									<th>Gender</th>
									<th>Rating</th>
									<th>Distance</th>
								</tr>
							</thead>
							<tbody>
								<!-- table row 1 -->
								<tr>
									<td><a href="individual_sample.php?<?php echo 'id=' . $tblID[0] ?>"><?php echo (isset($tblBuilding[0]))?$tblBuilding[0]:'';?></a></td>
									<td><?php echo (isset($tblBuilding[0]))?$tblGender[0]:'';?></td>
									<td><?php echo (isset($tblBuilding[0]))?round($tblRating[0], 1):'';?></td>
									<td><?php echo (isset($tblBuilding[0]))?round($tblDistance[0], 1):'';?></td>
								</tr>
								<!-- table row 2 -->
								<tr>
									<td><a href="individual_sample.php?<?php echo 'id=' . $tblID[1] ?>"><?php echo (isset($tblBuilding[1]))?$tblBuilding[1]:'';?></a></td>
									<td><?php echo (isset($tblBuilding[1]))?$tblGender[1]:'';?></td>
									<td><?php echo (isset($tblBuilding[1]))?round($tblRating[1], 1):'';?></td>
									<td><?php echo (isset($tblBuilding[1]))?round($tblDistance[1], 1):'';?></td>
								</tr>
								<!-- table row 3 -->
								<tr>
									<td><a href="individual_sample.php?<?php echo 'id=' . $tblID[2] ?>"><?php echo (isset($tblBuilding[2]))?$tblBuilding[2]:'';?></a></td>
									<td><?php echo (isset($tblBuilding[2]))?$tblGender[2]:'';?></td>
									<td><?php echo (isset($tblBuilding[2]))?round($tblRating[2], 1):'';?></td>
									<td><?php echo (isset($tblBuilding[2]))?round($tblDistance[2], 1):'';?></td>
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
	</body>
</html>