<?php    
	include 'inc/dbh.php';
	include 'inc/Format.php';

	$fm = new Format();

	date_default_timezone_set('Africa/Lagos');

	//Save Data to Database
	if (isset($_POST['done'])) {
		$question = mysqli_real_escape_string($conn, $fm->cleanUserInput($_POST['question']));

		// This Checks if you're training the bot or not by check the question input for special characters
		function multiexplode($delimeters,$string) {
			$ready = str_replace($delimeters, $delimeters[0], $string);
			$send = explode($delimeters[0], $ready);
			return $send;
		}
		$text = $question; //Synthax e.g train:who is your master # Kazeem
		$exploded = multiexplode(array(":","#"),$text);
		$arrlength = count($exploded);
		$command = $exploded[0];
		$commandQuestion = $exploded[1];
		$commandAnswer = $exploded[2];

		//Insert if there is a "train" keyword
		if ($command == "train" || $command == "Train") {
			$query =  mysqli_query($conn,"INSERT INTO tbl_chat (question, answer) VALUES ('$commandQuestion', '$commandAnswer')");

		}
		// If There is no "train" keyword, treat the input as question and get an answer for it.
		else {
			$query =  "SELECT * FROM tbl_chat WHERE question LIKE '%$question%' LIMIT 1";
			$result = $conn->query($query);
			while ($row = $result->fetch_assoc()) {
				$question = $row['question'];
				$answer = $row['answer'];
				$date = $row['date'];
			}
			if ($result) {
				$sql = mysqli_query($conn,"INSERT INTO tbl_msg (question, answer, dates) VALUES ('$question', '$answer', '$date')");
			}
		}

	}
	//display data from database
	if (isset($_POST['display'])) {
		$sql2 =  "SELECT * FROM tbl_msg";
		$result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()) {
			?>

			<div class="question chatMsg" id="ask">
				<h5>You:</h5>
				<p><?php echo $row2['question']; ?></p>
				<p class="date"><?php echo $fm->formatDate($row2['dates']); ?></p>
			</div>

			<div class="clear"></div>


			<div class="answer chatMsg" id="talk">
				<h5>Bot:</h5>
				<p id="reply">
					<?php echo $row2['answer'];	?>						
				</p>
				<p class="date"><?php echo $fm->formatDate($row2['dates']); ?></p>
			</div>
<?php	} exit();  } ?>