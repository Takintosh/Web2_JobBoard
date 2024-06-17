<?php

// Include the database configuration and models
require_once '../config/Database.php';
require_once '../app/Models/CompanyModel.php';

// Define the CompanyDAO class to interact with the company database table
class CompanyDAO {
    private $pdo; // PDO connection object

    // Constructor to initialize the PDO connection
    public function __construct() {
        // Get the singleton instance of Database and establish a connection
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Method to find a company by its ID
    public function findById($id) {
        // Prepare a SQL statement to select a company by its ID
        $stmt = $this->pdo->prepare("SELECT * FROM company WHERE id = :id");
        // Bind the ID parameter to the SQL statement
        $stmt->bindParam(':id', $id);
        // Execute the SQL statement
        $stmt->execute();
        // Fetch the result row as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a row is returned, map it to a CompanyModel object
        if ($row) {
            $company = new CompanyModel();
            // Set the properties of the CompanyModel object
            $company->setId($row['id']);
            $company->setName($row['name']);
            $company->setLogo($row['logo']);
            $company->setContactEmail($row['contact_email']);
            $company->setContactPhone($row['contact_phone']);
            $company->setWebsite($row['website']);
            // Return the populated CompanyModel object
            return $company;
        }
        // If no row is returned, return null
        return null;
    }

}
