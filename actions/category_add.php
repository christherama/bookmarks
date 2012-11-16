<?php
// Start the session
session_start();

// Import functions.php
require_once('../functions.php');
require_once('../config/db.php');

// Default redirect location & message
$location = '../';
$message = null;
$post = false;

// If this is a post request
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Extract POST data
	extract($_POST);
	$category_name = addslashes($category_name);
	
	// Check to see if all info was provided
	if($category_name == '') {
		$location = '../?p=category_add';
		$message = 'Please provide all required information.';
		$post = true;
	} else {
		// Connect to the DB
		$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

		// Construct query
		$sql = "INSERT INTO categories (category_name) VALUES('$category_name')";

		// Execute query
		$result = $conn->query($sql);

		// If successful
		if($result != null) {
			$message = "<strong>$category_name</strong> has been successfully added!";
		} else { // else, must have failed
			$message = 'Something went wrong on the server. Please try adding the category again.';
			$post = true;
		}
		// Close DB connection
		unset($conn);
	}
} else {
	$message = 'Please use the navigation provided.';
}

// Redirect to next page
redirect($location,$message,$post);
