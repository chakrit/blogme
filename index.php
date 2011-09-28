<?php
  include 'include/db.php';
  
  $counter = 0;
  $posts = array();
  
  // load posts from database
  $result = mysql_query("SELECT * FROM posts", $mysql) or die("Error while fetching posts list: " . mysql_error($mysql));
  while ($row = mysql_fetch_array($result)) {
    $posts[$counter++] = array(
      'post_id' => $row['post_id'],
      'content' => $row['content'],
      'view_count' => $row['view_count']);
  }

  mysql_close($mysql);
  
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
