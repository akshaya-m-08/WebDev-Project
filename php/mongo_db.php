<?php
require 'vendor/autoload.php';

// MongoDB connection parameters
$mongoHost = 'localhost';
$mongoPort = 27017;
$mongoDBName = 'guvi';
$collectionName = 'students';

try 
{
    // Connect to MongoDB server
    $mongoClient = new MongoDB\Client("mongodb://$mongoHost:$mongoPort");

    // Access the database
    $database = $mongoClient->$mongoDBName;

    // Check if the collection already exists
    $collections = $database->listCollections();
    $collectionExists = false;
    foreach ($collections as $collection) 
    {
        if ($collection->getName() === $collectionName) 
        {
            $collectionExists = true;
            break;
        }
    }

    // Create the collection if it doesn't exist
    if (!$collectionExists) 
    {
        $database->createCollection($collectionName);
    }
} 
catch (MongoDB\Driver\Exception\Exception $e) 
{
    // Throw error if MongoDB connection fails
    die(json_encode(array('status' => false, 'msg' => 'Failed to connect to MongoDB')));
}
?>
