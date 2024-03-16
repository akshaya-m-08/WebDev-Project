<?php

require 'vendor/autoload.php'; //

$redis = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");

// $url = parse_url(getenv("REDISCLOUD_URL"));
// $host = "redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com";
// $port = 17411;
// $password = "ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU";

// $redis_red = new Redis();

// $redis_red->auth($password);

// $options = ["stream" => ["verify_peer" => false, "verify_peer_name" => false]];

// $redis_red->setOptions($options);

?>
