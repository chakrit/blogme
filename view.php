<?php
  include 'db.php';
  include 'redis.php';
  
  // validate params
  is_numeric($post_id = $_GET['post_id']) or die("post_id must be a number.");
  
  // update view count
  $query = "UPDATE posts SET view_count = (view_count + 1) WHERE post_id = $post_id";
  mysql_query($query, $mysql) or die("error incrementing view count");
  
  // fetch display data
  $query = 'SELECT * FROM posts WHERE post_id=$post_id';
  $result = mysql_query($query, $mysql) or die('error fetching post #$post_id');
  $result = mysql_fetch_array($result);
  
  $post = array(
    'post_id' => $result['post_id'],
    'content' => htmlentities($result['content']),
    'view_count' => $result['view_count']);
  
?>
<html>
  <body>
    <h1>Post <?= $post['post_id'] ?></h1>
    <p><?= $post['content'] ?></p>
    <p><strong><?= $post['view_count'] ?> views.</strong></p>
  </body>
</html>
