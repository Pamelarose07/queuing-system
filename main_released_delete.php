<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbPath)) {
    die('Could Not Find Database File');
}

try {
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the IDs from the form data
    $ids = $_POST['ids'];

    // Use prepared statement to prevent SQL injection
    $stmt = $db->prepare("DELETE FROM released_takeout WHERE ID IN (" . implode(',', $ids) . ")");
    $stmt->execute();

    // Redirect to the view page after deletion
    header("Location: main.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
