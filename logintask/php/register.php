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

if (isset($_POST['action']) && $_POST['action'] == 'registration') {
    $first_name = validateData($_POST['firstName']);
    $last_name = validateData($_POST['lastName']);
    $email_id = validateData($_POST['emailId']);
    $contact_number = validateData($_POST['contactNumber']);
    $password = validateData($_POST['password']);
    $confirm_password = validateData($_POST['confirmPassword']);
    
    $error_message = '';
	
	$sql1="SELECT * FROM `tbl_registration` WHERE `email_id` = ?";
    $checkEmailQuery = $conn->prepare($sql1);
    $checkEmailQuery->bind_param('s', $email_id);
    $checkEmailQuery->execute();
	//$checkEmailQuery->error_list;
    
    $result = $checkEmailQuery->get_result();
    if ($result->num_rows > 0) {
        
        $error_message = "Email ID already exists !";
        echo $error_message;
    } else {
        $insertQuery = $conn->prepare("insert into tbl_registration(first_name,last_name,email_id,contact_number,password) values(?,?,?,?,?)");
        $password = md5($password);
        $insertQuery->bind_param("sssss", $first_name, $last_name, $email_id, $contact_number, $password);
        
        if ($insertQuery->execute()) {
            echo "Thankyou for registration.";
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