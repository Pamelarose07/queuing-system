<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbPath)) {
    die('Could Not Find Database File');
}

try {
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the IDs parameter from the POST request
    $ids = $_POST['ids'];

    // Convert the comma-separated string to an array
    $idArray = explode(',', $ids);

    // Use prepared statement to prevent SQL injection
    $stmt = $db->prepare("INSERT INTO released_takeout (released_number) SELECT Note FROM TakeOut WHERE ID IN (" . implode(',', array_fill(0, count($idArray), '?')) . ") AND (Note NOT LIKE 'PU%' AND Note NOT LIKE 'GF%')");
    $stmt->execute($idArray);

    // Insert into pickup table if Note starts with 'PU' or 'WB'
    $stmtPickup = $db->prepare("INSERT INTO pickup (pickup_num) SELECT Note FROM TakeOut WHERE ID IN (" . implode(',', array_fill(0, count($idArray), '?')) . ") AND (Note LIKE 'PU%' OR Note LIKE 'GF%')");
    $stmtPickup->execute($idArray);

    // Delete the numbers from the takeout table
    $stmtDelete = $db->prepare("DELETE FROM TakeOut WHERE ID IN (" . implode(',', array_fill(0, count($idArray), '?')) . ")");
    $stmtDelete->execute($idArray);

    // Redirect to the view page after deletion
    header("Location: main.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
