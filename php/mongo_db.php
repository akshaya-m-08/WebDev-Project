<?php

require '../vendor/autoload.php'; 

$mongodburl = parse_url(getenv("MONGODB_URL"));
$mongoUser = 'akshaya08';
$mongopassword = 'Abhi1%40aks';
$mongoDBName = 'guvi';
$collectionName = 'students';

$mongoClient = new MongoDB\Client("mongodb+srv://$mongoUser:$mongopassword@cluster0.s7e4jmk.mongodb.net");

$database = $mongoClient->$mongoDBName;

?>