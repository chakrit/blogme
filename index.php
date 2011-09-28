<?php
  include 'db.php';
  include 'redis.php';
  
  $counter = 0;

  $posts = array();
  
  // load posts from database
  $result = mysql_query("SELECT * FROM posts", $mysql);
  while ($row = mysql_fetch_array($result)) {
    $posts[$counter++] = array(
      'blog_id' => $row['blog_id'],
      'content' => $row['content'],
      'view_count' => $row['view_count']);
  }
  
?>
<html>
  <body>
    <h1>Posts!</h1>
    <ul>
      <?php foreach ($posts as $post) { ?>
      <li>
        <a href="view.php?blog_id=<?= $post['blog_id'] ?>">
          <?= $post['content'] ?></a>
        (<?= $post['view_count'] ?> views)
      </li>
      <?php } ?>
    </ul>
  </body>
</html>
