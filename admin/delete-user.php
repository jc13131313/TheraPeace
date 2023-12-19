<?php
// delete-user.php

// Include the database connection file
include '../database/database.php';

if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
    // Get the user ID and username from the POST data
    $userId = $_POST["userId"];
    $username = $_POST["username"];

    try {
        // Delete the user from the database
        $deleteSql = "DELETE FROM users WHERE id = :userId";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $deleteStmt->execute();

        echo "User " . $username . " deleted successfully.";
    } catch (PDOException $e) {
        // Log the error to a file
        file_put_contents('delete_user_error.log', date('Y-m-d H:i:s') . ' - Error: ' . $e->getMessage() . "\n", FILE_APPEND);

        echo "Error deleting user. Please check the server logs for more details.";
    }
} else {
    echo "Invalid request method.";
}
?>
