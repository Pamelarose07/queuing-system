<?php
$dbFile = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbFile)) {
    die('Could Not Find Database File');
}

try {
    $pdo = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbFile; Uid=; Pwd=;");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error connecting to the database: ' . $e->getMessage());
}
