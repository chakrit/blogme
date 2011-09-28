<?
  include 'db.php';

  $query = <<<EOT
  CREATE TABLE  `blogme`.`posts` (
    `blog_id` BIGINT NOT NULL AUTO_INCREMENT,
    `content` TEXT NOT NULL,
    `view_count` INT NOT NULL,
    PRIMARY KEY (`blog_id`)
  ) ENGINE = MYISAM ;
  EOT;
  
  mysql_query($query) or die("Could not create table `posts`.");
  
?>
