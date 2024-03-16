<?php

session_start();

include "redisconnect.php";




include "mongo_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    function validate($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']): '';
    $student_password = isset($_POST['student_password']) ? validate($_POST['student_password']) : '';

    $_SESSION['student_email'] = $student_email;

    $filter = ['student_email' => $student_email];
    $result = $database->$collectionName->findOne($filter);

    if ($result !== null) {
        // Verify the entered password against the hashed password
        if (password_verify($student_password, $result['student_password'])) {
            // Passwords match
            die(json_encode(array('status' => true)));
        } else {
            // Passwords don't match
            die(json_encode(array('status' => false, 'msg' => "Invalid Password")));
        }
    } else {
        // User not found
        die(json_encode(array('status' => false, 'msg' => "Invalid Username")));
    }
}

?>
