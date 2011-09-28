<?php
  include 'include/redis.php';
  
  $counter = 0;
  $posts = array();
  
  function load_from_db() {
    global $redis;

    include 'include/db.php';
    
    $result = mysql_query("SELECT * FROM posts", $mysql) or die("Error while fetching posts list: " . mysql_error($mysql));
    while ($row = mysql_fetch_array($result)) {
      $posts[$counter++] = array(
        'post_id' => $row['post_id'],
        'content' => $row['content'],
        'view_count' => $row['view_count']);
    }
    
    if (!$redis->setnx("posts:list:lock"))
      return; // only one thread should prime the cache
    
    // prime the cache transactionally
    $multi = $redis->multi();
    foreach ($posts as $post) {
      $key = "posts:" . $post['post_id'];
      $multi = $multi->hMset($key, $post)
        ->rpush("posts:list", $key);
    }
    
    $multi = $multi->del("posts:list:lock") // unlocks
      ->exec();
  }
  
  function load_from_redis() {
    global $redis;
    
    $keys = $redis->lrange("posts:list", 0, -1);
    $multi = $redis->multi();
    foreach ($keys as $key) {
      $multi = $multi->hGetAll($key);
    }
    
    $posts = $multi->exec();
  }
  
  // load posts from database
  if ($redis->exists("posts:list")) {
    load_from_redis();
  } else {
    load_from_db();
  }
  
?>
<html>
  <body>
    <h1>Posts!</h1>
    <ul>
      <?php foreach ($posts as $post) { ?>
      <li>
        <a href="view.php?post_id=<?= $post['post_id'] ?>">
          <?= $post['content'] ?></a>
        (<?= $post['view_count'] ?> views)
      </li>
      <?php } ?>
    </ul>
  </body>
</html>
