<?php

require_once('db_connect.php');

$destination_comment_id = $_POST['destination_comment_id'] === '' ? 'NULL' : $_POST['destination_comment_id'];
$content = $_POST['content'];

$sql = "INSERT INTO comments(destination_comment_id, content) VALUES ($destination_comment_id, '$content')";

$db->exec($sql);

header('Location: index.php');