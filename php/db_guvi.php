<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS guvi";


// Select the database
$conn->select_db("guvi");

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS student (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    student_password VARCHAR(255) NOT NULL,
    student_email VARCHAR(255) NOT NULL,
    student_number BIGINT (15) NOT NULL,
    student_dob DATE NOT NULL
)";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
