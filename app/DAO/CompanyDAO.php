<?php

require_once '../config/Database.php';
require_once '../app/Models/CompanyModel.php';

class CompanyDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM company WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $company = new CompanyModel();
            $company->setId($row['id']);
            $company->setName($row['name']);
            $company->setLogo($row['logo']);
            $company->setContactEmail($row['contact_email']);
            $company->setContactPhone($row['contact_phone']);
            $company->setWebsite($row['website']);
            return $company;
        }

        return null;
    }

}
