<?php
  include 'db.php';
  include 'redis.php';
  
  // load posts from database
  $result = mysql_query("SELECT * FROM posts", $mysql);
  while ($row = mysql_fetch_array($result)) {
    $model['posts'][$counter++] = array(
      'blog_id' => $row['blog_id'],
      'content' => $row['content'],
      'view_count' => $row['view_count'])
  }
  
?>
<html>
  <body>
    <h1>It works!</h1>
    <ul>
    <?php foreach ($post in $model['posts']) { ?>
      <li>
        (<?= $post['view_count'] ?> views)
        <a href="view.php?blog_id=<?= $post['blog_id'] ?>">
          <?= substr($post['content'], 0, 20) ?>
        </a>
      </li>
    <?php } ?>
    </ul>
  </body>
</html>
