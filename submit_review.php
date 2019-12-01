<?php

	session_start();
	require_once "config.php";

	$reviewStar = $_POST['reviewStar'];
	$reviewText = $_POST['reviewText'];
	$bathroomId = $_POST['bathroomId'];
	$avgRating = $_POST['avgRating'];

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