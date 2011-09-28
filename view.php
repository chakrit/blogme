<?php
  include 'include/db.php';
  include 'include/redis.php';
  
  // validate params
  is_numeric($post_id = $_GET['post_id']) or die("post_id must be a number.");
  
  // update view count
  $query = "UPDATE posts SET view_count = (view_count + 1) WHERE post_id = $post_id";
  mysql_query($query, $mysql) or die("Error incrementing view count: " . mysql_error($mysql));
  
  // fetch display data
  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $result = mysql_query($query, $mysql) or die("Error fetching post $post_id: " . mysql_error($mysql));
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
