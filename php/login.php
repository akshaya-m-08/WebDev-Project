<?php
include "redisconnect.php";

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

    $student_email = isset($_POST['student_email']) ? validate($_POST['student_email']): '';
    $student_password = isset($_POST['student_password']) ? validate($_POST['student_password']) : '';

    $sql = "SELECT * FROM student WHERE student_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row !== null) 
    {
        if (password_verify($student_password, $row['student_password'])) 
        {
            session_regenerate_id(true); 
            $_SESSION['student_email'] = $student_email; 
            $_SESSION['student_name'] = $row["student_name"];
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
