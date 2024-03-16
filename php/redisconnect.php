<?php

require '../vendor/autoload.php'; //

$redis = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com:17411?auth=ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU');


?>
