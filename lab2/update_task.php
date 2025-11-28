<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $naslov = $_POST["naslov"] ?? '';
    $rok = $_POST["rok"] ?? '';
    $prioritet = $_POST["prioritet"] ?? '';
    $status = $_POST["status"] ?? '';

//validacija
    if (empty($naslov) || empty($rok) || empty($prioritet) || empty($status) ) {
        echo "Сите полиња се задолжителни.";
        exit;
    }

    $valid_priorities = ['Low', 'Medium', 'High'];
    $valid_statuses = ['Pending', 'Done'];

    if (!in_array($prioritet, $valid_priorities)) {
        echo "Приоритетот мора да биде една од вредностите: Low, Medium, High.";
        exit;
    }

    if (!in_array($status, $valid_statuses)) {
        echo "Статусот мора да биде една од вредностите: Pending, Done.";
        exit;
    }

    $db = connectDatabase();
    $stmt = $db->prepare("UPDATE zadaci SET naslov = :naslov, rok = :rok, prioritet = :prioritet, status = :status WHERE id = :id");
    $stmt->bindValue(':naslov', $naslov, SQLITE3_TEXT);
    $stmt->bindValue(':rok', $rok, SQLITE3_TEXT);
    $stmt->bindValue(':prioritet', $prioritet, SQLITE3_TEXT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);

    $stmt->execute();

    $db->close();
    header("Location: index.php");
    exit();


}else{
    echo "Invalid Request";
}

