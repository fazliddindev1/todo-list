<?php
include('db.php');
$id = $_GET['id'] ?? 0;
$task = $connection->query("SELECT * FROM tasks WHERE id = $id")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['task']);
  $stmt = $connection->prepare("UPDATE tasks SET name = ? WHERE id = ?");
  $stmt->bind_param("si", $name, $id);
  $stmt->execute();
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Edit Task</h3>
  <form method="POST">
    <div class="input-group">
      <input type="text" name="task" value="<?= htmlspecialchars($task['name']) ?>" class="form-control" required>
      <button class="btn btn-success">Update</button>
    </div>
  </form>
</div>
</body>
</html>