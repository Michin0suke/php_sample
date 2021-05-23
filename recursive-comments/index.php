<?php

require_once('db_connect.php');

$root_comments = $db->query('SELECT * FROM comments WHERE destination_comment_id IS NULL ORDER BY created_at DESC');

function print_comments($comment, $depth=0) {
  global $db;
  $id = $comment['id'];
  $content = $comment['content'];
  $margin_left = ($depth * 20).'px';

  echo "<li style='margin-left: $margin_left'>$id: $content</li>";

  $replied_comments = $db->query("SELECT * FROM comments WHERE destination_comment_id = $id ORDER BY created_at DESC");

  while($replied_comment = $replied_comments->fetchArray()) {
    print_comments($replied_comment, $depth + 1);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<form action="insert.php" method="post">
  <p>返信先のコメントID: <input name="destination_comment_id"></p>
  <p>コメント内容: <input name="content" required></p>
  <p><input type="submit" value="送信"></p>
</form>
<?php while($root_comment = $root_comments->fetchArray()):?>
<ul>
  <?php print_comments($root_comment) ?>
</ul>
<?php endwhile ?>
</body>
</html>