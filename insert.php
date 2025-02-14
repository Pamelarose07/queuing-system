<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbPath)) {
    die('Could Not Find Database File');
}

try {
    // Establish connection
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get data from the form
    $data = $_POST['data'];

    // Use prepared statement to prevent SQL injection
    $stmt = $db->prepare("INSERT INTO takeout (num) VALUES (:num)");
    $stmt->bindParam(':num', $data);
    $stmt->execute();

    // Redirect to the view page after insertion
    header("Location: main.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
