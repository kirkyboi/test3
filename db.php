<?php
// db.php
$host = 'localhost';
$dbname = 'ubuntu'; // Updated to your specified database name
$username = 'root';
$password = ''; // Replace with your MySQL password if set

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
