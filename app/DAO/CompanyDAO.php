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
            $company->setDescription($row['description']);
            $company->setSlug($row['slug']);
            // Return the populated CompanyModel object
            return $company;
        }
        // If no row is returned, return null
        return null;
    }

    public function findBySlug($slug) {
        // Prepare a SQL statement to select a company by its slug
        $stmt = $this->pdo->prepare("SELECT * FROM company WHERE slug = :slug");
        // Bind the slug parameter to the SQL statement
        $stmt->bindParam(':slug', $slug);
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
            $company->setDescription($row['description']);
            $company->setSlug($row['slug']);
            // Return the populated CompanyModel object
            return $company;
        }
        // If no row is returned, return null
        return null;
    }

    public function findAll() {
        // Prepare a SQL statement to select all companies
        $stmt = $this->pdo->query("SELECT * FROM company");
        // Fetch all result rows as an associative array
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize an empty array to store CompanyModel objects
        $companies = [];
        // Iterate over the result rows
        foreach ($rows as $row) {
            // Create a new CompanyModel object
            $company = new CompanyModel();
            // Set the properties of the CompanyModel object
            $company->setId($row['id']);
            $company->setName($row['name']);
            $company->setLogo($row['logo']);
            $company->setContactEmail($row['contact_email']);
            $company->setContactPhone($row['contact_phone']);
            $company->setWebsite($row['website']);
            $company->setDescription($row['description']);
            $company->setSlug($row['slug']);
            // Add the CompanyModel object to the array
            $companies[] = $company;
        }
        // Return the array of CompanyModel objects
        return $companies;
    }

}
