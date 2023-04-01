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

function ajaxUpdate() {
	$(".error").text("");
	$('#first-name-info').removeClass("error");
	$('#last-name-info').removeClass("error");
	$('#register-email-info').removeClass("error");
	$('#contact-no-info').removeClass("error");
	$('#age-info').removeClass("error");
	$('#dob-info').removeClass("error");

	var firstName = $('#first-name').val();
	var lastName = $('#last-name').val();
	var emailId = $('#register-email-id').val();
	var contactNumber = $('#contact-number').val();
	var age = $('#age').val();
	var dob = $('#dob').val();
	var actionString = 'update';

	if (firstName == "") {
		$('#first-name-info').addClass("error");
		$(".error").text("required");
	} else if (!pregMatch(firstName)) {
		$('#first-name-info').addClass("error");
		$(".error").text('Alphabets and white space allowed');
	} else if (lastName == "") {
		$('#last-name-info').addClass("error");
		$(".error").text("required");

	} else if (!pregMatch(lastName)) {
		$('#last-name-info').addClass("error");
		$(".error").text('Alphabets and white space allowed');
	} else if (emailId == "") {
		$('#register-email-info').addClass("error");
		$(".error").text("required");
	} else if (!validateEmailId(emailId)) {
		$('#register-email-info').addClass("error");
		$(".error").text("Invalid");
	} else if (contactNumber == "") {
		$('#contact-no-info').addClass("error");
		$(".error").text("required");
	} else if (isNaN(contactNumber) || (contactNumber.indexOf(" ") != -1) || contactNumber.length > 10 || contactNumber.length < 10) {
		$('#contact-no-info').addClass("error");
		$(".error").text("Invalid");
	} else if (age == "") {
		$('#age-info').addClass("error");
		$(".error").text("required");
	} else if (isNaN(age) || (age.indexOf(" ") != -1) || age.length > 2) {
		$('#age-info').addClass("error");
		$(".error").text("Invalid");
	} else if (dob == "") {
		$('#dob-info').addClass("error");
		$(".error").text("required");
	} else if (dob.length > 10) {
		$('#dob-info').addClass("error");
		$(".error").text("Invalid");
	}  else {
		$('#loaderId').show();
		$.ajax({
			url : 'profile_update.php',
			type : 'POST',
			data : {
				firstName : firstName,
				lastName : lastName,
				emailId : emailId,
				contactNumber : contactNumber,
				age : age,
				dob : dob,
				action : actionString
			},
			success : function(response) {
				if (response.trim() == 'error') {
					$('#update-success-message').hide();
					$('#ajaxloader').hide();
					$('#update-error-message').html(
							"Invalid Attempt. Try Again.");
					$('#update-error-message').show();
				} else {
					$(".thank-you-update").show();
					$(".thank-you-update").text(response);
					
				}
			}

		});
		this.close();
	}// endif
}