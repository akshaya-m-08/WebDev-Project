<?php


// Start Redis session handler
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{    
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

    include "db_guvi.php";

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
        $sql = "INSERT INTO student (student_name, student_password, student_email, student_number, student_dob) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssis', $student_name, $student_password, $student_email, $student_number, $student_dob);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
        {
            // Data inserted into MySQL, now copy it to MongoDB for Profile page handling
            include "mongo_db.php";
            
            $data = array
            (
                'student_name' => $student_name,
                'student_password' => $student_password,
                'student_email' => $student_email,
                'student_number' => $student_number,
                'student_dob' => $student_dob
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