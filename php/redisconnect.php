<?php
$url = parse_url(getenv("REDISCLOUD_URL"));
$redis = new Redis();
$redis->connect("tls://".$url["redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com"], $url["17411"], 0, NULL, 0, 0, [
  "auth" => $url["ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU"],
  "stream" => ["verify_peer" => false, "verify_peer_name" => false],
]);

?>
