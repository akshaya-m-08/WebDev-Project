<?php
require '../vendor/autoload.php'; 
try 
{
    
    $redis = new Predis\Client(array(
        'host' => ('redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com'),
        'port' => (17411),
        'password' => ('ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU'),
    ));

    function updateProfileDataInRedis($redis, $student_email, $row) 
    {
        $redis->hset('ProfileData', $student_email, json_encode($row));
    }
}
catch (Predis\Connection\ConnectionException $e) 
{
    error_log("Redis Connection Error: " . $e->getMessage());
    die("Redis Connection Error");
}
catch (Predis\Response\ServerException $e)
{
    error_log("Redis Server Error: " . $e->getMessage());
    die("Redis Server Error");
}
catch (Exception $e) 
{
    error_log("General Error: " . $e->getMessage());
    die("General Error");
}

?>
