<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, username, firstname, lastname, email FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        $deleteSql = "DELETE FROM users WHERE id = :userId";
        $deleteStmt = $this->pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $deleteStmt->execute();
    }
}

?>
