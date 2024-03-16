<?php
$url = parse_url(getenv("REDISCLOUD_URL"));
$host = "redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com";
$port = 17411;
$password = "ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU";

$redis = new Redis();

$redis->auth($password);

$options = ["stream" => ["verify_peer" => false, "verify_peer_name" => false]];

$redis->setOptions($options);

?>
