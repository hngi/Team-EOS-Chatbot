$(document).ready(function(){
	displayChat(); // Displays the chat(s) immediately the page loads

	var user = $("#user").data("user"); // get user ID

		// submit the user inputs
		$("#submit_message").click(function(){
			var question = $("#question").val();
			
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
					//displayChat();
					$("#question").val(data);
					$("#error").textContent(data);
				}
			}) 
		});
	});

	// This displays the chat
	function displayChat() {
		$.ajax({
			url: "ajax.php",
			type: "POST",
			async: false,
			data: {
				"display": 1,
				"userId" : user
			},
			success: function(d){
				$("#dropbox").html(d);
			}
		});
	}
	
window.onload = function() {
    var reloading = sessionStorage.getItem("reloading");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        myFunction();
    }
}

function reloadP() {
    sessionStorage.setItem("reloading", "true");
    document.location.reload();
}