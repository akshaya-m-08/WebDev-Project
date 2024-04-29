<?php
$sqlurl = parse_url(getenv("FREESQL_URL"));
$servername = "sql6.freesqldatabase.com";
$username = "sql6702344";
$userport = 3306;
$password = "fML1122Z7z";
$database = "sql6702344";

$active_group = 'default';
$query_builder = TRUE;

$conn =mysqli_connect($servername, $username, $password, $database);

 if (!$conn)
{
    die("Connection failed: " .mysqli_connect_error());
}
