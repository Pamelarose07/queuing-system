<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbPath)) {
    die('Could Not Find Database File');
}

try {
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set the timezone to 'Asia/Manila'
    date_default_timezone_set('Asia/Manila');

    // Get the IDs parameter from the POST request
    $ids = $_POST['ids'];

    // Convert the comma-separated string to an array
    $idArray = explode(',', $ids);

    // Create an array for placeholders in the SQL query
    $placeholders = implode(',', array_fill(0, count($idArray), '?'));

    // Use the current date and time in the SQL query with AM/PM indicator
    $currentDateTime = date('Y-m-d h:i:s A');

    // Use prepared statement to prevent SQL injection
    $stmt = $db->prepare("INSERT INTO claim_takeout (claim, date_time) SELECT released_number, ? FROM released_takeout WHERE ID IN ($placeholders)");

    // Bind the current date and time to the placeholder
    $stmt->bindParam(1, $currentDateTime, PDO::PARAM_STR);

    // Bind the other parameters (IDs) in the array
    foreach ($idArray as $index => $id) {
        $stmt->bindParam($index + 2, $id, PDO::PARAM_INT);
    }

    // Execute the prepared statement
    $stmt->execute();

    // Delete the numbers from the takeout table
    $stmt = $db->prepare("DELETE FROM released_takeout WHERE ID IN ($placeholders)");

    // Bind the parameters (IDs) in the array
    foreach ($idArray as $index => $id) {
        $stmt->bindParam($index + 1, $id, PDO::PARAM_INT);
    }

    // Execute the prepared statement
    $stmt->execute();

    // Redirect to the view page after deletion
    header("Location: main.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
