<?php
include 'db_connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

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

    $stmt = $db->prepare("INSERT INTO zadaci (naslov, rok, prioritet, status) VALUES (:naslov, :rok, :prioritet, :status)");
    $stmt->bindValue(':naslov', $naslov, SQLITE3_TEXT);
    $stmt->bindValue(':rok', $rok, SQLITE3_TEXT);
    $stmt->bindValue(':prioritet', $prioritet, SQLITE3_TEXT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);

    if ($stmt->execute()) {

        header("Location: index.php");
    } else {
        echo "Error adding student: " . $db->lastErrorMsg();
    }

$db->close();


}else{
    echo "Invalid Request";
}

?>