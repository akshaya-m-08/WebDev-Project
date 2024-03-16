<?php

require '../vendor/autoload.php'; //

$redis = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");

?>
