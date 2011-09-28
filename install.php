<?
  include 'include/db.php';

  header('Content-Type', 'text/plain');

  function create_table() {
    global $mysql;

    $query = '
      CREATE TABLE `blogme`.`posts` (
        `blog_id` BIGINT NOT NULL AUTO_INCREMENT,
        `content` TEXT NOT NULL,
        `view_count` INT NOT NULL,
        PRIMARY KEY (`blog_id`)
      ) ENGINE = MYISAM;';
  
    mysql_query($query, $mysql) or die("Could not create table `posts`.");
  }
  
  function insert_data($content) {
    global $mysql;

    $query = "
      INSERT INTO `blogme`.`posts` (
        `content`,
        `view_count`
      ) VALUES (
        '$content', 0
      )";

    mysql_query($query, $mysql) or die("Error inserting sample data: " . mysql_error($mysql)); 
  }
  
  create_table();
  insert_data("the quick brown fox jumps over the lazy dog.");
  insert_data("the lazy brown dog jumps over the quick fox.");
  insert_data("the quick fox jumps over the lazy brown dog.");
  insert_data("the lazy fox jumps over the quick brown fox.");
  
?>
