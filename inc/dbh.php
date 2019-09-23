<?php

$conn = mysqli_connect("localhost", "root", "", "project_chatbot");

if(!$conn){
	die("Could not connect to the server, please try again" . mysqli_connection_error());
}
?>