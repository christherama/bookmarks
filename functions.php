<?php
/**
 * Convenience function to check to see whether or not the current request is a POST request
 * @return True if the request is a POST request, false otherwise
 */
function is_post() {
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Convenience function to format a MySQL date
 * @param $mysql_date Date fetched from MySQL database
 * @return Date formatted as m.d.yy
 */
function format_date($mysql_date) {
	$datetime = strtotime($mysql_date);
	return date('n.j.Y',$datetime);
}

/**
 * Redirects to a specified location
 * @param $message Message to display after redirect
 * @param $post Whether or not to pass on posted data
 */
function redirect($location,$message=null,$post=false) {
	if($message != null) {
		$_SESSION['message'] = $message;
	}
	
	if($post) {
		$_SESSION['POST'] = $_POST;
	}
	header("Location:$location");
}

function get_categories() {
	// Connect to database
	$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

	// Construct SQL
	$sql = 'SELECT * FROM categories';

	// Execute query
	$results = $conn->query($sql);

	$categories = null;

	// If query was successful (no SQL errors)...
	if ($results != null) {
		// If there is at least one row in the result set...
		if ($conn->affected_rows > 0) {
			$categories = array();
			// Loop through results, adding a table row
			while($category = $results->fetch_object()) {
				$categories[] = $category;
			}
		}
	}

	// Disconnect from DB
	unset($conn);

	return $categories;
}