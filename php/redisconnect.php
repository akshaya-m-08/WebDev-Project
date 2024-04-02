<?php
require '../vendor/autoload.php'; 

$redisHost = 'redis-17411.c16.us-east-1-3.ec2.cloud.redislabs.com';
$redisPort = 17411;
$redisPassword = 'ZB7bivbf2DQXsIBmVucdDpcerEhHUEtU';

$redis = new Predis\Client([
    'scheme' => 'tcp', 
    'host'   => $redisHost,
    'port'   => $redisPort,
    'password' => $redisPassword,
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);

class RedisSessionHandler implements SessionHandlerInterface {
    private $redis;

    public function __construct($redis) 
    {
        $this->redis = $redis;
    }

    public function open($savePath, $sessionName) 
    {
        return true;
    }    public function close() 
    {
        return true;
    }
    public function read($sessionId) 
    {
      $data = $this->redis->get("session:$sessionId");
      if ($data) {
        return unserialize($data);
      }
      return '';
    }

    public function write($sessionId, $data) 
    {
      $serializedData = serialize($data);
      $this->redis->set("session:$sessionId", $serializedData);
      return true;
    }   


    public function destroy($sessionId) 
    {
        return true;
    }

    public function gc($maxlifetime) 
    {
        return true;
    }
}


$sessionHandler = new RedisSessionHandler($redis);

session_set_save_handler($sessionHandler, true);

session_start();

?>
