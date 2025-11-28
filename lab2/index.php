<?php
include 'db_connection.php';
$db = connectDatabase();
//FETCH all tasks
$query = "SELECT * FROM zadaci";
$result = $db->query($query);

if (!$result) {
    die("Error fetching students: " . $db->lastErrorMsg());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tasks</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Task List</h1>
    <a href="add_task_form.php">
        Add Task
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Naslov</th>
        <th>Rok</th>
        <th>Prioritet</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($task = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['id']); ?></td>
                <td><?php echo htmlspecialchars($task['naslov']); ?></td>
                <td><?php echo htmlspecialchars($task['rok']); ?></td>
                <td><?php echo htmlspecialchars($task['prioritet']); ?></td>
                <td><?php echo htmlspecialchars($task['status']); ?></td>
                <td>
                    <form action="delete_task.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="update_task_form.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No tasks found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>