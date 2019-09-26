<?php
	include 'inc/dbh.php';

	session_start();
	$username = $_SESSION['user'];
	if (!isset($username)) {
		header("Location: index.html");
	}

	$check =  "SELECT * FROM users WHERE user ='$username' LIMIT 1";
	$checkResult = $conn->query($check);
	while ($row = $checkResult->fetch_assoc()) {
		$userId = $row['id'];
	}

	date_default_timezone_set('Africa/Lagos');
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="images/logoD.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<title>EOS chat-page</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="chat-side">
					<div class="chat-header">
						<!-- <div class="header-title"> -->
							<img src="images/logos-hipchat.svg" class="logo" width="15%">
							<span class="logo-name">Buzz Donna</span>
							
						<!-- </div> -->
					</div>
					
					<div class="chat-body">
						<!-- Bot Greetings -->
						<div class="chatbox right">
							<div class="chatbox-inner">
								<div class="chatbox-content">
									Hey <?php echo $username; ?>, I will be your health provider today.<br>How may i help you?
								</div>
							</div>
						</div>	

						<!-- User chats with bot -->
						<div id="dropbox">
							<!-- The messages/Chats will appear here -->
						</div>
					</div>

					<div class="send">
						<div class="form-group">
							<div class="input-group">
								<div id="error"></div>
								<input type="text" class="form-control" id="question" placeholder="Talk to Donna, she is a masterpiece">
								<input type="hidden" id="user" data-user="<?php echo $userId; ?>">
								<div class="input-group-addon">
									<button id="submit_message"><i class="fa fa-paper-plane"></i></button>
								</div>
							</div>							
						</div>
						<!-- <button id="close_chat">Close Chat</i></button> -->
					</div>
				</div>

			</div>
		

			<div class="col-md-6 text-center second-panel">
				<!-- <div class="col-md-8"> -->
					<img src="images/logoD.png" class="logo" alt="donnas" width="50%">
					<h3 class="name">Buzz Donna</h3>
					<p class="description">The Fitness Guardian</p>
				<!-- </div>				 -->
			</div>		
		</div>
	</div>
</body>
<!-- Chatbot App js requirement -->
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- <script type="text/javascript" src="js/chat.js"></script> -->
<script>
	$(document).ready(function() {
		displayChat(); // Displays the chat(s) immediately the page loads

		// submit the user inputs
		$("#submit_message").click(function(){
			var question = $("#question").val();
			var user = $("#user").data("user"); // get user ID
			
			$.ajax({
				url: "ajax.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
					"userId" : user,
					"question" : question
				},
				success: function(data){
					displayChat();
					$("#question").val('');
				}
			}) 
		});
	});

	// This displays the chat
	function displayChat() {
		var userId = $("#user").data("user"); // get user ID
		$.ajax({
			url: "ajax.php",
			type: "POST",
			async: false,
			data: {
				"display": 1,
				"userId" : userId
			},
			success: function(d){
				//$(".bot-reply").hide();
				//setTimeout(delayBotReply, 1000); // The bot reply will display after 1.5 secs
				$("#dropbox").html(d);
			}
		});
	}

	// delay the bot reply function
	// function delayBotReply() {
	// 	$(".bot-reply").show();
	// }
</script>

</html>