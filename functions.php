<?php
function format_date($mysql_date) {
	$datetime = strtotime($mysql_date);
	return date('n.j.Y',$datetime);
}

function redirect($location,$message=null,$post=false) {
	if($message != null) {
		$_SESSION['message'] = $message;
	}
	
	if($post) {
		$_SESSION['POST'] = $_POST;
	}
	header("Location:$location");
}