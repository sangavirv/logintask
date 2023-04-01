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
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $emailId = validateData($_POST['emailId']);
    $password = validateData($_POST['password']);
    $password = md5($password);
    $error_message = '';
    
    $selectQuery = $conn->prepare("select * from tbl_registration where email_id = ? and password = ?");
    $selectQuery->bind_param("ss", $emailId, $password);
    $selectQuery->execute();
    
    $result = $selectQuery->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['username'] = $row['first_name'];
			            // header("Location: dashboard.php");
           require_once "dashboard.php";
            exit();
        } // endwhile
    } // endif
else {
        $error_message = "error";
    } // endElse
    $conn->close();
    
    echo $error_message;
}
?>