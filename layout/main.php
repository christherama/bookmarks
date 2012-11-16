<?php
// Get page to display
$page = isset($_GET['p']) ? $_GET['p'] : DEFAULT_PAGE;

// If message is to be flashed, FLASH IT!
if(isset($_SESSION['message'])) {
	echo "<p class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>{$_SESSION['message']}</p>";
	unset($_SESSION['message']);
}

// Display page
include("views/$page.php")

?>