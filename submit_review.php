<?php

	session_start();

	$reviewStar = $_POST['reviewStar'];
	$reviewText = $_POST['reviewText'];

	// $params = array($_GET['id'], $_SESSION["id"], $reviewStar, $reviewText);
	// $query="INSERT INTO reviews (objectID, userID, rating, description) VALUES (?, ?, ?, ?)";
	// $result = sqlsrv_query($conn, $query, $params);
	// if( $result === false ) {
	// 	echo "ERROR<br>";
	// 	$errors=sqlsrv_errors();
	// 	echo "<br>";
	// 	print_r($errors);
	// 	echo "<br>";
	//     die();
	// }
	// print_r($_POST);
	echo "reviewStar is " . $reviewStar . ". reviewText is " . $reviewText . ". Session id is " . $_SESSION["id"];
?>