<?php    
	include 'inc/dbh.php';
	include 'inc/Format.php';

	$fm = new Format();

	date_default_timezone_set('Africa/Lagos');

	//Save Data to Database
	if (isset($_POST['done'])) {
		$question = mysqli_real_escape_string($conn, $fm->cleanUserInput($_POST['question']));
		$userId = $fm->cleanUserInput($_POST['userId']);

		$searchForTrain = strpos($question, "train"); // search for the word train
		
		if ($searchForTrain !== false) {
			// This Checks if you're training the bot or not by check the question input for special characters
			function multiexplode($delimeters,$string) {
				$ready = str_replace($delimeters, $delimeters[0], $string);
				$send = explode($delimeters[0], $ready);
				return $send;
			}
			$text = $question; //Synthax e.g train:who is your master # Kazeem
			$exploded = multiexplode(array(":","#"),$text);
			$arrlength = count($exploded);
			
			if ($arrlength < 2) {
				echo "Oops! I'm very sorry, i don't have answer to your question at the moment!";
			} else {
				$command = $exploded[0];
				$commandQuestion = $exploded[1];
				$commandAnswer = $exploded[2];
				//Insert if there is a "train" keyword
				if ($command === "train" || $command === "Train" ) {
					// Insert the question and answer into the database.
					$query =  mysqli_query($conn,"INSERT INTO message (question, answer) VALUES ('$commandQuestion', '$commandAnswer')");
					if (!$query) {
						echo "Could not submit your command to train the bot!";
					}
				}
				
			}
		}		
		// If There is no "train" keyword, treat the input as question and get an answer for it.
		else {
			// get the question and answer from the message table.
			$query =  "SELECT * FROM message WHERE question LIKE '%$question%' LIMIT 1";
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				// if selection was successful
				while ($row = $result->fetch_assoc()) {
					$question = $row['question'];
					$answer = $row['answer'];
				}

				// insert into the chat table where we will we display to the user his question and answer.
				$sql = mysqli_query($conn, "INSERT INTO chats (userId, question, answer) VALUES ('$userId', '$question', '$answer')");
			}
			else {
				// If the bot does not know the answer
				$reply = "Oops! I am very sorry, i do not have answer to your question at the moment.<br>I will inform Team EOS to give you a befitting reply as soon as possible.";

				$sqlAgain = mysqli_query($conn, "INSERT INTO chats (userId, question, answer) VALUES ('$userId', '$question', '$reply')");
				if ($sqlAgain) {
					echo "Insert successful";
					exit();
				}
			}
		}
	}
	
	//display data from database
	if (isset($_POST['display'])) {

		$userChat = $_POST['userId']; // get user id

		$sql2 =  "SELECT * FROM chats WHERE userId = '$userChat'";
		$result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()) {
			?>

			<!-- Question here -->
			<div class="chatbox left pull-right">
				<div class="chatbox-inner">
					<div class="chatbox-content left">
						<?php echo $row2['question']; ?><br>
						<small>
							<?php echo $fm->formatDate($row2['dates']); ?>
						</small>
					</div>
				</div>
			</div>
			
			<!-- Answer here -->
			<div class="chatbox right bot-reply">
				<div class="chatbox-inner">
					<div class="chatbox-content">
						<?php echo $row2['answer'];	?>
						<br>
						<small>
							<?php echo $fm->formatDate($row2['dates']); ?>
						</small>
					</div>
				</div>
			</div>
<?php	} exit();  } ?>