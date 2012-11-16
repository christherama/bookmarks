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
	$bookmark_name = addslashes($bookmark_name);
	$bookmark_url = addslashes($bookmark_url);
	$bookmark_description = addslashes(htmlentities($bookmark_description));
	
	// Check to see if all info was provided
	if($bookmark_name == '' || $bookmark_url == '' || $bookmark_description == '') {
		$location = '../?p=bookmark_add';
		$message = 'Please provide all required information.';
		$post = true;
	} else {
		// Connect to the DB
		$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

		// Construct query
		$sql = "INSERT INTO bookmarks (bookmark_name,bookmark_url,bookmark_description) VALUES('$bookmark_name','$bookmark_url','$bookmark_description')";

		// Execute query
		$result = $conn->query($sql);

		// If successful
		if($result != null) {
			$message = "<strong>$bookmark_name</strong> has been successfully added!";
		} else { // else, must have failed
			$message = 'Something went wrong on the server. Please try adding the bookmark again.';
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
