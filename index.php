<!DOCTYPE html>
<html>
<head>
	<title>TEAM EOS Chatbot App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="chatBot" id="chatBot">
		<div class="clear"></div>
		<div id="dropbox">
			<!--The Messages Appear Here-->
		</div>
		
		<div class="text" id="chatForm">
			<!--<textarea name="question" class="form">Enter Text</textarea> -->
			<input type="text" id="question" required="required" class="form" placeholder="Ask a question">
			<input type="submit" class="mybtn" id="submit_message" value="Send">
		</div>
	</div>
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
</body>
</html>