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
if(is_post()) {
	// Extract POST data
	extract($_POST);
	$bookmark_name = addslashes($bookmark_name);
	$bookmark_url = addslashes($bookmark_url);
	$bookmark_description = addslashes(htmlentities($bookmark_description));
	
	// Check to see if all info was provided
	if($bookmark_name == '' || $bookmark_url == '' || $bookmark_description == '') {
		$location = "../?p=bookmark_edit&id=$bookmark_id";
		$message = 'Please provide all required information.';
		$post = true;
	} else {
		// Connect to the DB
		$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

		// Check for a selected category
		$category_id = isset($category_id) && $category_id != '' ? $category_id : 'NULL';

		// Construct query
		$sql = "UPDATE bookmarks SET bookmark_name='$bookmark_name',bookmark_url='$bookmark_url',bookmark_description='$bookmark_description',category_id=$category_id WHERE bookmark_id=$bookmark_id";

		// Execute query
		$conn->query($sql);

		// If successful
		if($conn->affected_rows == 1) {
			$message = "<strong>$bookmark_name</strong> has been successfully updated!";
		} else { // else, must have failed
			$location = "../?p=bookmark_edit&id=$bookmark_id";
			$message = 'Something went wrong on the server. Please try editing the bookmark again.';
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
