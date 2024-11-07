<?php
// delete.php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user with the given ID from the database
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // Redirect back to index.php after deletion
    header("Location: index.php");
    exit();
} else {
    // If no ID is provided, redirect to index.php
    header("Location: index.php");
    exit();
}
?>
