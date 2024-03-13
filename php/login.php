<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

session_start();

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

    $hashed_password = password_hash($student_password, PASSWORD_DEFAULT);

    $filter = ['student_email' => $student_email, 'student_password' => $hashed_password];
    $result = $database->$collectionName->findOne($filter);

    if ($result !== null) {
        die(json_encode(array('status' => true)));
    } else {
        die(json_encode(array('status' => false, 'msg'=>"Invalid Username or Password")));
    }
}
?>
