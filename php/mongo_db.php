<?php

require 'vendor/autoload.php'; 

$mongoUser = 'akshaya08';
$mongopassword = 'Abhi1%40aks';
$mongoDBName = 'guvi';
$collectionName = 'students';

$mongoClient = new MongoDB\Client("mongodb+srv://$mongoUser:$mongopassword@ycluster0.ioqdfch.mongodb.net");

$database = $mongoClient->$mongoDBName;

?>