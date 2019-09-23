<?php
class Format{
	public function formatDate($date){
		date_default_timezone_set('Africa/Lagos');
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function cleanUserInput($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}
?>