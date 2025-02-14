<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

// Retrieve the value from the POST request (assuming the form uses POST method)
$numValue = $_POST['numberInput'];

// Insert data into the "takeout" table
$sql = "INSERT INTO takeout (num) VALUES ('$numValue')";
$conn->Execute($sql);

// Close the database connection
$conn->Close();
