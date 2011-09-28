<?php
  include 'include/redis.php';

  header('Content-Type', 'text/plain');

  for ($i = 0; $i < 10; $i++) {
    echo $redis->ping() . "\r\n"; 
  } 
?>
