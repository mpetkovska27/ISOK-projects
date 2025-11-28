<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    $_SESSION['error'] = "Access denied.";
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT type FROM events WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event && $event['type'] === 'privaten') {
        $_SESSION['error'] = "Private event can not be deleted.";
        header("Location: ../index.php");
        exit();
    }

    $stmt = $db->prepare("DELETE FROM events WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $db = null;

    header("Location: ../index.php");
    exit();
} else {
    echo "Invalid request.";
}
?>