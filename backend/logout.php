<?php 

session_start();
if ($_SESSION['user_id']) {
	unset($_SESSION['user_id']);
	$url = "index.php";

	unset($_SESSION['email']);
	if (isset($_GET['session_expired'])) {
		$url .= "?session_expired=" . $_GET['session_expired'];
	}
	header("location:$url");
}

?>