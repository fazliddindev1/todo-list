<?php
include('db.php');
$id = $_POST['id'] ?? 0;
$task = $connection->query("SELECT completed FROM tasks WHERE id = $id")->fetch_assoc();
$newStatus = $task['completed'] ? 0 : 1;
$connection->query("UPDATE tasks SET completed = $newStatus WHERE id = $id");
header("Location: index.php");
exit;
?>