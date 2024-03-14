<?php
$sqlurl = parse_url(getenv("JAWSDB_URL"));
$servername = "qn66usrj1lwdk1cc.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "c7vxy08pcs9fuvum";
$userport = 3306;
$password = "v10q2u5vkxnoyen3";
$database = "ita2g6ato5l2k3my";

$active_group = 'default';
$query_builder = TRUE;

$conn =mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) 
{
    die("Connection failed: " .mysqli_connect_error());
}


