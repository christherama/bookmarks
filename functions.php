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

/**
 * Fetches all categories from the database
 * @return Array of categories
 */
function get_categories() {
	// Connect to database
	$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

	// Construct SQL
	$sql = 'SELECT category_id AS id, category_name AS name FROM categories';

	// Execute query
	$results = $conn->query($sql);

	$categories = null;

	// If query was successful (no SQL errors)...
	if ($results != null) {
		// If there is at least one row in the result set...
		if ($conn->affected_rows > 0) {
			$categories = array();
			// Loop through results, adding a table row
			while($category = $results->fetch_assoc()) {
				$categories[] = $category;
			}
		}
	}

	// Disconnect from DB
	unset($conn);

	return $categories;
}

/**
 * Generates an input (text/password) element with the indicated name & type, checking for SESSION data for default values
 * @param String $name Value to use in name attribute
 * @param String $type Value to use in type attribute
 * @param String $placeholder Value to use in placeholder attribute
 * @param String $class Class name(s) for input element
 * @return String input element
 */
function input($name, $type, $placeholder='', $class='', $id='') {
	$value = '';
	// Check for session data for this input element
	if(isset($_SESSION['POST'][$name])) {
		$value = $_SESSION['POST'][$name];
		unset($_SESSION['POST'][$name]);
	}

	return "<input name=\"$name\" type=\"$type\" id=\"$id\" class=\"$class\" placeholder=\"$placeholder\" value=\"$value\" />";
}
/**
 * Generates a textarea element with the indicated name, checking for SESSION data for default values
 * @param String $name Value to use in name attribute
 * @param Integer $rows Value to use in rows attribute
 * @param String $placeholder Value to use in placeholder attribute
 * @param String $class Class name(s) for input element
 * @return String textarea element
 */
function textarea($name, $rows=2, $placeholder='', $class='', $id='') {
	$value = '';
	// Check for session data for this input element
	if(isset($_SESSION['POST'][$name])) {
		$value = $_SESSION['POST'][$name];
		unset($_SESSION['POST'][$name]);
	}

	return "<textarea name=\"$name\" id=\"$id\" rows=\"$rows\" class=\"$class\" placeholder=\"$placeholder\">$value</textarea>";
}

/**
 * Generates a select element with the indicated options & name, checking for SESSION data for default values
 * @param Array $options Array of options, each in the form array(id => someid, value => somevalue)
 * @param String $name Value to use in name attribute
 * @param String $placeholder Value to use in placeholder attribute
 * @param String $class Class name(s) for input element
 * @return String textarea element
 */
function dropdown($options, $name, $placeholder='', $class='', $id='') {
	$select = "<select name=\"$name\" class=\"$class\" id=\"$id\">";
	$select .=		"<option value=\"\">$placeholder</option>";
	foreach($options as $option) {
		$selected = '';
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name] == $option['id']) {
			$selected = 'selected="selected"';
			unset($_SESSION['POST'][$name]);
		}

		$select .=	"<option value=\"{$option['id']}\" $selected>{$option['name']}</option>";
	}
	$select .= "</select>";
	return $select;
}