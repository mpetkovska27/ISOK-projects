<?php
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add new event</title>
</head>
<body>
<h1>Add new Event</h1>
<form action="../handlers/create_handler.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br />
    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required>
    <br />
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>
    <br />

    <label for="type">Event type</label>
    <select name="type" id="type">
        <option value="javen">javen</option>
        <option value="privaten">privaten</option>
    </select>
    <br />
    <button type="submit">Add Event</button>
    <a href="../index.php">Go back</a>
</form>
</body>
</html>