<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>To-Do List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="text-center mb-4">📝 To-Do List</h1>
  
  <!-- Form to Add Task -->
  <form action="add.php" method="POST" class="mb-4">
    <div class="input-group">
      <input type="text" name="task" class="form-control" placeholder="Enter new task" required>
      <button class="btn btn-primary" type="submit">Add</button>
    </div>
  </form>

  <!-- Filter Links -->
  <div class="mb-3">
    <a href="?filter=all" class="btn btn-sm btn-outline-secondary">All</a>
    <a href="?filter=done" class="btn btn-sm btn-outline-success">Done</a>
    <a href="?filter=notdone" class="btn btn-sm btn-outline-warning">Not Done</a>
  </div>

  <!-- Task List -->
  <ul class="list-group">
    <?php
      $filter = $_GET['filter'] ?? 'all';
      $sql = "SELECT * FROM tasks";
      if ($filter === 'done') $sql .= " WHERE completed = 1";
      if ($filter === 'notdone') $sql .= " WHERE completed = 0";

      $sql .= " ORDER BY created_at DESC";
      $tasks = $connection->query($sql);

      while ($task = $tasks->fetch_assoc()):
    ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <form action="toggle.php" method="POST" class="d-flex align-items-center">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <input type="checkbox" onchange="this.form.submit()" <?= $task['completed'] ? 'checked' : '' ?>>
        <span class="ms-2 <?= $task['completed'] ? 'text-decoration-line-through text-muted' : '' ?>">
          <?= htmlspecialchars($task['name']) ?>
        </span>
      </form>
      <div>
        <a href="edit.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-info">Edit</a>
        <a href="delete.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
      </div>
    </li>
    <?php endwhile; ?>
  </ul>
</div>
</body>
</html>