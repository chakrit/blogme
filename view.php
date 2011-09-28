<?php
  include 'include/redis.php';
    
  // validate params
  is_numeric($post_id = $_GET['post_id']) or die("post_id must be a number.");
  
  $key = "posts:" . $post_id;
 
  // only loads from the cache, redirect user to the index so the cache gets primed on first hit
  if (!($redis->exists($key))) {
    header('Location: http://127.0.0.1/index.php');
    exit(0);
  }
  
  $post = $redis->hGetAll($key);
  
?>
<html>
  <body>
    <h1>Post <?= $post['post_id'] ?></h1>
    <p><?= $post['content'] ?></p>
    <p><strong><?= $post['view_count'] ?> views.</strong></p>
  </body>
</html>
