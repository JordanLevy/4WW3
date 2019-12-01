<?php

	session_start();
	require_once "config.php";

	$reviewStar = $_POST['reviewStar'];
	$reviewText = $_POST['reviewText'];
	$bathroomId = $_POST['bathroomId'];

	// print_r($_POST);
	echo "reviewStar is " . $reviewStar . ". reviewText is " . $reviewText . ". Session id is " . $_SESSION["id"] . ". Bathroom id is " . $bathroomId;

	$params = array($bathroomId, $_SESSION["id"], $reviewStar, $reviewText);
	$query="INSERT INTO reviews (objectID, userID, rating, description) VALUES (?, ?, ?, ?)";
	$result = sqlsrv_query($conn, $query, $params);
	if( $result === false ) {
		echo "ERROR<br>";
		$errors=sqlsrv_errors();
		echo "<br>";
		print_r($errors);
		echo "<br>";
	    die();
	}

	//calculate the average rating
	$params = array($bathroomId);
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
	//if it's zero rows
	if(sqlsrv_has_rows($result) != 1){
		   echo "0 rows";
	}else{
		//get the query results
		while($row = sqlsrv_fetch_array($result)){
			$avgRating = $row[0];
		}
	}

	$params = array($avgRating, $bathroomId);
	$query="UPDATE objects SET rating = ? WHERE id = ?";
	$result = sqlsrv_query($conn, $query, $params);
	if( $result === false ) {
		echo "ERROR<br>";
		$errors=sqlsrv_errors();
		echo "<br>";
		print_r($errors);
		echo "<br>";
	    die();
	}
?>