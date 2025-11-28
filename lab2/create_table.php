<?php
$db = new SQLite3(__DIR__ . '/database/db.sqlite');

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS zadaci (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    naslov TEXT NOT NULL,
    rok TEXT NOT NULL,
    prioritet TEXT NOT NULL,
    status TEXT NOT NULL
);
SQL;

if ($db->exec($createTableQuery)) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $db->lastErrorMsg();
}

$db->close();
?>