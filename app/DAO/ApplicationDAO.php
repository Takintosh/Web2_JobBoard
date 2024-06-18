<?php

// Include necessary files for database connection and models
require_once '../config/Database.php';
require_once '../app/Models/JobOpeningModel.php';
require_once '../app/Models/UserModel.php';
require_once '../app/DAO/JobOpeningDAO.php';
require_once '../app/DAO/UserDAO.php';

// Define ApplicationDAO class to handle database operations for applications
class ApplicationDAO {

    // Property to hold the PDO connection object
    private $pdo;

    // Constructor to initialize the PDO connection
    public function __construct() {
        // Get the singleton instance of the Database and establish a connection
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Method to save a new application to the database
    public function save(ApplicationModel $application) {
        // Prepare an SQL statement for inserting a new application record
        $stmt = $this->pdo->prepare("INSERT INTO application (jobOpeningId, userId) VALUES (:jobOpeningId, :userId)");

        // Retrieve job opening ID and user ID from the ApplicationModel object
        $jobOpeningId = $application->getJobOpeningId();
        $userId = $application->getUserId();

        // Bind parameters to the prepared statement
        $stmt->bindParam(':jobOpeningId', $jobOpeningId);
        $stmt->bindParam(':userId', $userId);

        // Execute the prepared statement and return the result
        return $stmt->execute();
    }

    // Method to find an application by job opening ID and user ID
    public function findByJobOpeningAndUser(ApplicationModel $application) {
        // Prepare an SQL statement for selecting an application record based on job opening ID and user ID
        $stmt = $this->pdo->prepare("SELECT * FROM application WHERE jobOpeningId = :jobOpeningId AND userId = :userId");

        // Retrieve job opening ID and user ID from the ApplicationModel object
        $jobOpeningId = $application->getJobOpeningId();
        $userId = $application->getUserId();

        // Bind parameters to the prepared statement
        $stmt->bindParam(':jobOpeningId', $jobOpeningId);
        $stmt->bindParam(':userId', $userId);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch and return the result of the query
        return $stmt->fetch();
    }

    // Method to find all applications for a specific job opening
    public function findAllByJobOpening($jobOpeningId) {
        // Prepare an SQL statement for selecting all application records based on job opening ID
        $stmt = $this->pdo->prepare("SELECT * FROM application WHERE jobOpeningId = :jobOpeningId");
        // Bind the job opening ID parameter to the prepared statement
        $stmt->bindParam(':jobOpeningId', $jobOpeningId);
        // Execute the prepared statement
        $stmt->execute();
        // Fetch all application records
        $results = $stmt->fetchAll();

        $applications = [];
        $userDAO = new UserDAO();

        foreach ($results as $row) {
            $application = new ApplicationModel();

            $user = $userDAO->findById($row['userId']);
            $application->setUser($user);
            $applications[] = $application;
        }
        return $applications;

    }

}
