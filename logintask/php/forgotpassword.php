<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once ('db.php');

function validateData($data)
{
    $resultData = htmlspecialchars(stripslashes(trim($data)));
    return $resultData;
}


	
if (isset($_POST['action']) && $_POST['action'] == 'chgpwd') {
   
    $email_id = validateData($_POST['emailId']);
   $password = validateData($_POST['password']);
    $confirm_password = validateData($_POST['confirmPassword']);
    
    
    $error_message = '';
	
	$sql1="SELECT * FROM `tbl_registration` WHERE `email_id` = ?";
    $checkEmailQuery = $conn->prepare($sql1);
    $checkEmailQuery->bind_param('s', $email_id);
    $checkEmailQuery->execute();
	//$checkEmailQuery->error_list;
    
    $result = $checkEmailQuery->get_result();
    if ($result->num_rows == 0) {
        
        $error_message = "Email Id not exists !";
        echo $error_message;
    } else {
		
		$password = md5($password);
        $updateQuery = $conn->prepare("UPDATE tbl_registration SET password = ? WHERE email_id =?");
      //  $password = md5($password);
        $updateQuery->bind_param("ss", $password, $email_id );
        
        if ($updateQuery->execute()) {
            echo "Updated Successfuly.";
			
            exit();
        } else {
            $error_message = "error";
        }
        $updateQuery->close();
        $conn->close();
        
        echo $error_message;
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>

<link rel="stylesheet" href="../css/style.css">

<link rel="stylesheet"
    href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <!--<script type="text/javascript" src="js/register.js"></script>-->
       
	   <script>
function validateEmailId(input) {
	var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (emailFormat.test(input)) {
		return true;
	} else {
		return false;
	}
}



function ajaxfgotpwd() {
	$(".error").text("");
	
	$('#register-email-info').removeClass("error");
	$('#register-passwd-info').removeClass("error");
	$('#confirm-passwd-info').removeClass("error");

	
	var emailId = $('#register-email-id').val();
	var password = $('#register-password').val();
	var confirmPassword = $('#confirm-password').val();
	var actionString = 'chgpwd';

	
	if (emailId == "") {
		$('#register-email-info').addClass("error");
		$(".error").text("required");
	} else if (!validateEmailId(emailId)) {
		$('#register-email-info').addClass("error");
		$(".error").text("Invalid");
	}  else if (password == "") {
		$('#register-passwd-info').addClass("error");
		$(".error").text("required");
	} else if (confirmPassword == "") {
		$('#confirm-passwd-info').addClass("error");
		$(".error").text("required");
	} else if (password != confirmPassword) {
		$('#confirm-passwd-info').addClass("error");
		$(".error").text("Your confirm password does not match.");
	} else {
		$('#loaderId').show();
		$.ajax({
			//url : 'forgotpassword.php',
			type : 'POST',
			data : {
			
				emailId : emailId,
				password : password,
				confirmPassword : confirmPassword,
				action : actionString
			},
			success : function(response) {
				if (response.trim() == 'error') {
					$('#register-success-message').hide();
					$('#ajaxloader').hide();
					$('#register-error-message').html(
							"Invalid Attempt. Try Again.");
					$('#register-error-message').show();
				} else {
					$(".thank-you-update").show();
					$(".thank-you-update").text(response);
					
				}
			}

		});
		this.close();
	}// endif
}	
	
	</script>
	

</head>

<body>

<div class="demo-container">

<h2>Change Your Password</h2>
       
        <div class="thank-you-update">
        </div>
<div     title="Form" >
    <form id="fgotpwd-form" action="" method="post" role="form">
       
        <div class="input-row">
            <span id="register-email-info"></span> <input type="email"
                name="register-email-id" id="register-email-id"
                class="input-field" placeholder="Email ID" value="">
        </div>
       
        <div class="input-row">
            <span id="register-passwd-info"></span> <input
                type="password" name="register-password"
                id="register-password" class="input-field"
                placeholder="Password">
        </div>
        <div class="input-row">
            <span id="confirm-passwd-info"></span> <input
                type="password" name="confirm-password"
                id="confirm-password" class="input-field"
                placeholder="Confirm Password">
        </div>
        <div class="submit-button">
            <input type="button" class="btn-submit" value="Submit"
                onclick="ajaxfgotpwd()">
        </div>

    </form>

<a href="../login.html">Login to your Account</a>
			
			
    <div class="success-message" id="register-success-message"
        style="display: none"></div>
    <div class="error-message" id="register-error-message"
        style="display: none"></div>
  
</div>

 </div>
	
</body>
</html>


