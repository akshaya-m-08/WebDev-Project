<?php

require '../vendor/autoload.php'; //

$redis = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");

// Custom session handling functions
function custom_session_open($save_path, $session_name) {
    global $redis;
    return true; // Return true to indicate success
}

function custom_session_close() {
    return true; // Return true to indicate success
}

function custom_session_read($session_id) {
    global $redis;
    return $redis->get("session:$session_id");
}

function custom_session_write($session_id, $session_data) {
    global $redis;
    $redis->set("session:$session_id", $session_data);
    return true; // Return true to indicate success
}

function custom_session_destroy($session_id) {
    global $redis;
    $redis->del("session:$session_id");
    return true; // Return true to indicate success
}

function custom_session_gc($maxlifetime) {
    return true; // Return true to indicate success
}

// Register custom session handling functions
session_set_save_handler(
    'custom_session_open',
    'custom_session_close',
    'custom_session_read',
    'custom_session_write',
    'custom_session_destroy',
    'custom_session_gc'
);

?>
