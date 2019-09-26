<?php
	include 'dbh.php';
	include 'Format.php';

	$fm = new Format();

	date_default_timezone_set('Africa/Lagos');

	if (!isset($_POST['submitUser'])) {
		header("Location: index.html");
	} else {
		function cleanUsersTextInput($data) {
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$user = cleanUsersTextInput($_POST['user']);

		$query =  mysqli_query($conn,"INSERT INTO users (user) VALUES ('$user')");
		if ($query) {
			session_start();
			$_SESSION['user'] = $user;
			header("Location: ../chat-page.php");
		}
	}
?>