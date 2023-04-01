function validateEmailId(input) {
	var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (emailFormat.test(input)) {
		return true;
	} else {
		return false;
	}
}

function pregMatch(input) {
	var regExp = /^[a-zA-Z ]*$/;

	if (regExp.test(input)) {
		return true;
	} else {
		return false
	}
}

// Function for user login
function ajaxLogin() {
	$(".error").text("");
	$('#email-info').removeClass("error");
	$('#password-info').removeClass("error");

	var emailId = $('#login-email-id').val();
	var password = $('#login-password').val();
	var actionString = 'login';

	if (emailId == "") {
		$('#email-info').addClass("error");
		$(".error").text("required");
	} else if (!validateEmailId(emailId)) {
		$('#email-info').addClass("error");
		$('.error').text("Invalid");
	} else if (password == "") {
		$('#password-info').addClass("error");
		$(".error").text("required");
	} else {
		// show loader
		$('#loaderId').show();
		$.ajax({
			url : 'php/login.php',
			type : 'POST',
			data : {
				emailId : emailId,
				password : password,
				action : actionString
			},
			success : function(response) {
				if (response.trim() == 'error') {
					$('#login-success-message').hide();
					$('#ajaxloader').hide();
					$('#login-error-message').html(
							"Invalid Attempt. Try Again.");
					$('#login-error-message').show();
				} else {
					//window.location.href = "php/dashboard.php";
					$('.demo-container').html(response);
					 
					//register_window.dialog("close");
					
				}
			}
		});
		this.close();
	}// endif
}