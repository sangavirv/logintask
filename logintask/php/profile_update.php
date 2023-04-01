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
	
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $first_name = validateData($_POST['firstName']);
    $last_name = validateData($_POST['lastName']);
    $email_id = validateData($_POST['emailId']);
    $contact_number = validateData($_POST['contactNumber']);
    $age = validateData($_POST['age']);
    $dob = validateData($_POST['dob']);
    
    $error_message = '';
	
	$sql1="SELECT * FROM `tbl_registration` WHERE `first_name` = ?";
    $checkEmailQuery = $conn->prepare($sql1);
    $checkEmailQuery->bind_param('s', $username);
    $checkEmailQuery->execute();
	//$checkEmailQuery->error_list;
	

    
    $result = $checkEmailQuery->get_result();
    if ($result->num_rows == 0) {
        
        $error_message = "Username not exists !";
        echo $error_message;
    } else {
		$row = $result->fetch_assoc();
			$email_id1 = $row['email_id'];
			
        $insertQuery = $conn->prepare("UPDATE tbl_registration SET first_name = ?,last_name = ?,
		email_id= ?,contact_number= ?,age= ?,dob= ? WHERE email_id =?");
      //  $password = md5($password);
        $insertQuery->bind_param("sssssss", $first_name, $last_name, $email_id, $contact_number, 
		$age, $dob, $email_id1 );
        
        if ($insertQuery->execute()) {
            echo "Updated Successfuly.";
			//header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "error";
        }
        $insertQuery->close();
        $conn->close();
        
        echo $error_message;
    }
}

?>