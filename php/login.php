<?php
include "redisconnect.php";
include "mongo_db.php";

session_start();

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com:17411?auth=ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    function validate($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']): '';
    $student_password = isset($_POST['student_password']) ? validate($_POST['student_password']) : '';
    
    $selectcollection = $database->selectCollection('students');
    $result = $selectcollection->findOne(['student_email' => $student_email]);

    if ($result !== null) {
        // Verify the entered password against the hashed password
        if (password_verify($student_password, $result['student_password'])) 
        {
            // Passwords match
            session_regenerate_id(true); 
            $_SESSION['student_email'] = $student_email;
            die(json_encode(array('status' => true, 'student_name' => $result["student_name"])));
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
