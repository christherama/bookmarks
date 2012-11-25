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

// If the bookmark id is provided in the QS
if(isset($_GET['id']) && $_GET['id'] != '') {
	
	// Connect to the DB
	$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);
	// Construct query
	$sql = "DELETE FROM bookmarks WHERE bookmark_id={$_GET['id']}";

	// Execute query
	$conn->query($sql);

	// If successful
	if($conn->affected_rows == 1) {
		$message = "Your bookmark has been successfully deleted!";
	} else { // else, must have failed
		$message = 'Something went wrong on the server. Please try deleting the bookmark again.';
	}
	// Close DB connection
	unset($conn);
} else {
	$message = 'Please use the navigation provided.';
}

// Redirect to next page
redirect($location,$message,$post);
