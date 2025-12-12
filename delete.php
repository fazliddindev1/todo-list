<?php
include('db.php');
$id = $_GET['id'] ?? 0;
$connection->query("DELETE FROM tasks WHERE id = $id");
header("Location: index.php");
exit;
?>