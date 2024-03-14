<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://default:ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU@redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com:17411?auth=ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['Profile'])) 
    {
        function validate($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']) : '';
        $student_password = isset($_POST['student_password']) ? validate($_POST['student_password']) : '';
        
        include "mongo_db.php";

        $selectcollection = $database->selectCollection('students');
        $user_profile = $selectcollection->findOne(['student_email' => $student_email]);

        if ($user_profile && password_verify($student_password, $user_profile["student_password"])) 
        {
            die(json_encode(array(
                "student_email" => $user_profile["student_email"], 
                "student_number" => $user_profile["student_number"], 
                "student_dob" => $user_profile["student_dob"], 
                "student_name" => $user_profile["student_name"]
            )));
            
        } 
        else 
        {

            die(json_encode(array("error" => "Profile not found or Incorrect Password")));
        } 
        
    }
}
?>
