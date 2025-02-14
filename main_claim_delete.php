<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbPath)) {
    die('Could Not Find Database File');
}

try {
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Use prepared statement to prevent SQL injection
    $stmt = $db->prepare("DELETE FROM claim_takeout");
    $stmt->execute();

    // Delete records from another table (claim_takeout)
    // $stmt2 = $db->prepare("DELETE FROM released_takeout");
    // $stmt2->execute();

    // Delete records from another table (claim_takeout)
    // $stmt3 = $db->prepare("DELETE FROM takeout");
    // $stmt3->execute();

    // Redirect to the view page after deletion
    header("Location: main.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
