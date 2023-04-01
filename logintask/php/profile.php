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

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
	}
		
		$selectQuery = $conn->prepare("select * from tbl_registration where first_name = ?");
    $selectQuery->bind_param("s", $username);
    $selectQuery->execute();
    
    $result = $selectQuery->get_result();
    
    if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
            $first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email_id = $row['email_id'];
			$contact_number = $row['contact_number'];
			$age = $row['age'];
			$dob = $row['dob'];
			
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

 <script type="text/javascript" src="../js/profile.js"></script>
       
</head>

<body>

<div class="demo-container">

<h2>Update Profile</h2>
       
        <div class="thank-you-update">
        </div>
<div  class="register-class"    title="Update Form" >
    <form id="update-form" action="" method="post" role="form">
        <div class="input-row">
            <span id="first-name-info"></span><label>First Name: </label> <input type="text"
                name="first-name" id="first-name" class="input-field"
                 value="<?php echo $first_name; ?>">
        </div>
        <div class="input-row">
            <span id="last-name-info"></span> <label>Last Name: </label><input type="text"
                name="last-name" id="last-name" class="input-field"
                value="<?php echo $last_name; ?>">
        </div>
        <div class="input-row">
            <span id="register-email-info"></span><label>Email Id: </label> <input type="email"
                name="register-email-id" id="register-email-id"
                class="input-field"  value="<?php echo $email_id; ?>">
        </div>
        <div class="input-row">
            <span id="contact-no-info"></span><label>Contact No: </label> <input type="text"
                name="contact-number" id="contact-number" maxlength="10"
                class="input-field" value="<?php echo $contact_number; ?>">
        </div>
		
		<div class="input-row">
            <span id="age-info"></span> <label>Age: </label><input type="text"
                name="age" id="age" maxlength="10"
                class="input-field" value="<?php if(!empty($age))
				{
					echo $age; 
				} else {
					echo "";
				}
				?>">
        </div>
		<div class="input-row">
            <span id="dob-info"></span><label>DOB: </label> <input type="text"
                name="dob" id="dob" maxlength="10"
                class="input-field" value="<?php if(!empty($dob))
				{
					echo $dob;
				} else {
					echo "";
				}
				?>">
        </div>
		
		
	
      <!--  <div class="input-row">
            <span id="register-passwd-info"></span> <input
                type="password" name="register-password"
                id="register-password" class="input-field"
                value="<?php echo $first_name; ?>">
        </div>
        <div class="input-row">
            <span id="confirm-passwd-info"></span> <input
                type="password" name="confirm-password"
                id="confirm-password" class="input-field"
                value="<?php echo $first_name; ?>">
        </div>-->
        <div class="submit-button">
            <input type="button" class="btn-submit" value="Update"
                onclick="ajaxUpdate()">
        </div>

    </form>

    <div class="success-message" id="update-success-message"
        style="display: none"></div>
    <div class="error-message" id="update-error-message"
        style="display: none"></div>


<a href="logout.php">Back</a>

</div>

 </div>
	
	

</body>
</html>