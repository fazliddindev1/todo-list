<?php
include('db.php');
if (isset($_POST['task'])) {
  $task = trim($_POST['task']);
  if ($task) {
    $stmt = $connection->prepare("INSERT INTO tasks (name) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
  }
}
header("Location: index.php");
exit;
?>