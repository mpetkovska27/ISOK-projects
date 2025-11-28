<?php
include './database/db_connection.php';
include './jwt_helper.php';

session_start();

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    $_SESSION['error'] = "Access denied.";
    header("Location: ../pages/auth/login.php");
    exit;
}

$db = connectDatabase();

$query = "SELECT * FROM events";
$result = $db->query($query);

if (!$result) {
    die("Error fetching events: " . $db->errorCode());
}
?>

<body>
<div>
    <h1>Events List</h1>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="error">
        <?php
        echo htmlspecialchars($_SESSION['error']);
        unset($_SESSION['error']);
        ?>
    </div>
    <?php endif; ?>

    <a href="pages/create.php">
        Add Event
    </a>
    <a href="handlers/auth/logout_handler.php">
        Logout
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Location</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($event = $result->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['name']); ?></td>
                <td><?php echo htmlspecialchars($event['location']); ?></td>
                <td><?php echo htmlspecialchars($event['date']); ?></td>
                <td><?php echo htmlspecialchars($event['type']); ?></td>
                <td>
                        <form action="handlers/delete_handler.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>

                    <form action="pages/edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No events found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>