<?php
require('db.php'); // Assuming you have a separate file for database connection, replace with your actual connection code.

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newNumber = $_POST['numberInput'];

    // Your PDO connection
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");

    // Your SQL insert statement
    $sqlInsert = "INSERT INTO pickup (pickup_num) VALUES (:num)";
    $stmt = $db->prepare($sqlInsert);
    $stmt->bindParam(':num', $newNumber);
    $stmt->execute();

    // Use output buffering to capture the echoed message
    ob_start();
    echo 'Data inserted successfully.';
    $output = ob_get_clean();

    // Check if there is a successful message
    if ($output === 'Data inserted successfully.') {
        // Redirect to main.php
        header('Location: main.php');
        exit();
    }
}
