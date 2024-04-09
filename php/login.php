<?php

include "db_guvi.php";

include "redisconnect.php";

$redisUpdate = new RedisConnect();

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

    $sql = "SELECT * FROM student WHERE student_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $redisUpdate->updateProfileData($student_email, $row);

    if ($row !== null) 
    {
        if (password_verify($student_password, $row['student_password'])) 
        {
            die(json_encode(array('status' => true, 'student_name' => $row["student_name"])));
        } 
        else 
        {
            die(json_encode(array('status' => false, 'msg' => "Invalid Password")));
        }
    } 
    else 
    {
        die(json_encode(array('status' => false, 'msg' => "Invalid Username")));
    }
}
?>
