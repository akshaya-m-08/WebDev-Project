<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    if (isset($_POST['myprofile'])) 
    {
        function validate($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']) : '';
        

        include "mongo_db.php";

        $selectcollection = $database->selectCollection('students');
        $user_profile = $selectcollection->findOne(['student_email' => $student_email]);

        if ($user_profile) 
        {
            die(json_encode(array(
                "student_email" => $user_profile["student_email"], 
                "student_number" => $user_profile["student_number"], 
                "student_dob" => $user_profile["student_dob"], 
                "student_name" => $user_profile["student_name"],
                "student_address" => $user_profile["student_address"]
            )));
        } 
        else 
        {
            die(json_encode(array("error" => "Profile not found")));
        } 
        
    }
    if (isset($_POST['update'])) 
    {
        function validate($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $student_name = isset($_POST['student_name']) ? validate($_POST['student_name']) : '';
        $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']) : '';
        $student_number = isset($_POST['student_number']) ? validate($_POST['student_number']) : '';
        $student_dob = isset($_POST['student_dob']) ? validate($_POST['student_dob']) : '';
        $student_address = isset($_POST['student_address']) ? validate($_POST['student_address']) : '';

        include "mongo_db.php";

        $selectcollection = $database->selectCollection('students');
        
        $user_profile = $selectcollection->findOne(['student_email' => $student_email]);

        if ($user_profile)  
        {
            $update_result = $selectcollection->updateOne
            (
                ['student_email' => $student_email],
                ['$set' => 
                [
                    'student_name' => $student_name,
                    'student_number' => $student_number,
                    'student_dob' => $student_dob,
                    'student_address' => $student_address
                ]]
            );

            if ($update_result->getModifiedCount() > 0) 
            {
                die(json_encode(array("status" => true)));
            } 
            else 
            {
                die(json_encode(array("status" => false, "error" => "Profile Not Updated Same Data or Internal Error")));
            }
        } 
           
        else 
        {
            die(json_encode(array("error" => "Profile not found or Incorrect Password ")));
        }
    }
}

?>
