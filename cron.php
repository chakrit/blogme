<?php
  include 'include/db.php';
  include 'include/redis.php';

  $keys = $redis->lrange("posts:list", 0, -1);

  foreach ($keys as $key) {
    $post = $redis->hGetAll($key); 
    $post_id = $post['post_id'];
    $view_count = $post['view_count'];

    $query = "UPDATE posts SET view_count = $view_count WHERE post_id = $post_id";
    mysql_query($query, $mysql) or die("Error updating view count for post #$post_id : " . mysql_error($mysql));
  } 

  $redis->close();
  mysql_close($mysql);

?>
