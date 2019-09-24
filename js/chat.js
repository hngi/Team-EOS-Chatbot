$(document).ready(function(){
	displayChat(); // Displays the chat(s) immediately the page loads

	// submit the user inputs
	$("#submit_message").click(function(){
		var question = $("#question").val();

		$.ajax({
			url: "ajax.php",
			type: "POST",
			async: false,
			data: {
				"done": 1,
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
	$.ajax({
		url: "ajax.php",
		type: "POST",
		async: false,
		data: {
			"display": 1
		},
		success: function(d){
			$("#dropbox").html(d);
		}
	});
}

function reloadP() {
    sessionStorage.setItem("reloading", "true");
    document.location.reload();
}