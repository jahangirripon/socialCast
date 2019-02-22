$(document).ready(function() {

	// on click signup, hide login and show registration
	$('#signup').click(function() {
		$('#first').slideUp("slow", function() {
			$('#second').slideDown("slow");
		});
	});

	// on click signin, hide signup and show login
	$('#signin').click(function() {
		$('#second').slideUp("slow", function() {
			$('#first').slideDown("slow");
		});
	});

});