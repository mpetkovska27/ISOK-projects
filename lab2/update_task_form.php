<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    // Fetch the current details
    $stmt = $db->prepare("SELECT * FROM zadaci WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $task = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid task ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
</head>
<body>
<h1>Update Task</h1>

<?php if ($task): ?>
    <form action="update_task.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">
        <label for="naslov">Naslov:</label>
        <input type="text" name="naslov" value="<?php echo htmlspecialchars($task['naslov']); ?>" required><br><br>
        <label for="rok">Rok:</label>
        <input type="text" name="rok" value="<?php echo htmlspecialchars($task['rok']); ?>" required><br><br>
        <label for="prioritet">Prioritet:</label>
        <input type="text" name="prioritet" value="<?php echo htmlspecialchars($task['prioritet']); ?>" required><br><br>
        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo htmlspecialchars($task['status']); ?>" required><br><br>

        <button type="submit">Update Task</button>
    </form>
<?php else: ?>
    <p>Task not found.</p>
<?php endif; ?>
</body>
</html>