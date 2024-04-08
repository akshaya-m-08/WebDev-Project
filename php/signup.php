<?php

include "db_guvi.php";

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

    $student_name = isset($_POST['student_name']) ? validate($_POST['student_name']) : '';
    $student_password = isset($_POST['student_password']) ? validate($_POST['student_password']) : '';
    $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']) : '';
    $student_number = isset($_POST['student_number']) ? validate($_POST['student_number']) : '';
    $student_dob = isset($_POST['student_dob']) ? validate($_POST['student_dob']) : '';
    $student_address = isset($_POST['student_address']) ? $_POST['student_address'] : '';

    $sql = "SELECT * FROM student WHERE student_email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) 
    {
        die(json_encode(array('status' => false, "msg" => "Account already exists with this email")));
    } 
    else 
    {
 
        if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) 
        {
            die(json_encode(array('status' => false, 'msg' => 'Enter a valid Email address')));
        }

        if (!preg_match('/^[a-zA-Z0-9._]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/', $student_email)) 
        {
            die(json_encode(array('status' => false, 'msg' => 'Enter a valid email address')));
        }
        
        if (!preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,15}$/', $student_password)) 
        {
            die(json_encode(array('status' => false, 'msg' => 'Password must contain a digit, a capital letter, a special character, and be 8-15 characters long')));
        }
        
        if (!preg_match('/^\d{10}$/', $student_number)) 
        {
            die(json_encode(array('status' => false, 'msg' => 'Enter Valid 10-digit mobile number')));
        } 


        
        $hashed_password = password_hash($student_password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO student (student_name, student_password, student_email, student_number, student_dob) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssis', $student_name, $hashed_password, $student_email, $student_number, $student_dob);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
        {
            include "mongo_db.php";
            
            $data = array
            (
                'student_name' => $student_name,
                'student_password' => $hashed_password,
                'student_email' => $student_email,
                'student_number' => $student_number,
                'student_dob' => $student_dob,
                'student_address' => $student_address
            );


            $insert = $database->$collectionName->insertOne($data);

            if ($insert->getInsertedCount() == 1) 
            {   
                die(json_encode(array('status' => true)));
            }
            else
            {
                die(json_encode(array('status'=> false, 'msg' => 'Database error. Please try again later.')));
            } 
        }
        else
        {
            die(json_encode(array('status'=> false, 'msg' => 'Error inserting data into database.')));
        }
    }
}
?>