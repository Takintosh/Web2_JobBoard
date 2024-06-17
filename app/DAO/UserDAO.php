<?php

// Import necessary files
require_once '../config/Database.php';
require_once '../app/Models/UserModel.php';

class UserDAO {
    private $pdo;

    public function __construct() {
        // Initialize the database connection
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function findByEmail($email) {
        // Prepare the SQL statement for finding a user by email
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        // Bind parameters to the prepared statement
        $stmt->bindParam(':email', $email);
        // Execute the query
        $stmt->execute();
        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Create a new UserModel object
            $user = new UserModel();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setRole($row['role']);
            $user->setLinkedin($row['linkedin']);
            $user->setPicture($row['picture']);
            // Return the user
            return $user;
        }
        return null;
    }

    public function create(UserModel $user) {
        // Prepare the SQL statement for inserting a new user
        $stmt = $this->pdo->prepare("INSERT INTO user (name, email, password, role, linkedin, picture) VALUES (:name, :email, :password, :role, :linkedin, :picture)");

        // Get user data from the UserModel object
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $role = $user->getRole();
        $linkedin = $user->getLinkedin();
        $picture = $user->getPicture();

        // Bind parameters to the prepared statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':picture', $picture);

        // Execute the query and return the result
        return $stmt->execute();
    }
}