<?php

require_once '../config/Database.php';
require_once '../app/Models/JobOpeningModel.php';
require_once '../app/DAO/CompanyDAO.php';

class JobOpeningDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function findAll() {

        $stmt = $this->pdo->query("SELECT * FROM job_opening");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jobOpenings = [];
        $companyDAO = new CompanyDAO();

        foreach ($results as $row) {
            $jobOpening = new JobOpeningModel();
            $jobOpening->setId($row['id']);
            $jobOpening->setTitle($row['title']);
            $jobOpening->setDescription($row['description']);
            $jobOpening->setCompany($row['company_id']);
            $jobOpening->setLocation($row['location']);
            $jobOpening->setContract($row['contract']);
            $jobOpening->setExperience($row['experience']);
            $jobOpening->setLevel($row['level']);
            $jobOpening->setStatus($row['status']);
            $jobOpening->setSalary($row['salary']);

            $company = $companyDAO->findById($row['company_id']);
            $jobOpening->setCompany($company);

            $jobOpenings[] = $jobOpening;
        }
        return $jobOpenings;
    }

    public function findAllActive() {
        $stmt = $this->pdo->query("SELECT * FROM job_opening WHERE status = 'active' ORDER BY publication_date DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jobOpenings = [];
        $companyDAO = new CompanyDAO();

        foreach ($results as $row) {
            $jobOpening = new JobOpeningModel();
            $jobOpening->setId($row['id']);
            $jobOpening->setTitle($row['title']);
            $jobOpening->setDescription($row['description']);
            $jobOpening->setCompany($row['company_id']);
            $jobOpening->setLocation($row['location']);
            $jobOpening->setContract($row['contract']);
            $jobOpening->setExperience($row['experience']);
            $jobOpening->setLevel($row['level']);
            $jobOpening->setStatus($row['status']);
            $jobOpening->setSalary($row['salary']);

            $company = $companyDAO->findById($row['company_id']);
            $jobOpening->setCompany($company);

            $jobOpenings[] = $jobOpening;
        }
        return $jobOpenings;
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM job_opening WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $companyDAO = new CompanyDAO();
        if($row) {
            $jobOpening = new JobOpeningModel();
            $jobOpening->setId($row['id']);
            $jobOpening->setTitle($row['title']);
            $jobOpening->setDescription($row['description']);
            $jobOpening->setCompany($row['company_id']);
            $jobOpening->setLocation($row['location']);
            $jobOpening->setContract($row['contract']);
            $jobOpening->setExperience($row['experience']);
            $jobOpening->setLevel($row['level']);
            $jobOpening->setStatus($row['status']);
            $jobOpening->setSalary($row['salary']);

            $company = $companyDAO->findById($row['company_id']);
            $jobOpening->setCompany($company);
            return $jobOpening;
        } else {
            return null;
        }
    }

    public function findByCompany($companyId) {
        $stmt = $this->pdo->prepare("SELECT * FROM job_opening WHERE (company_id = :company AND status = 'active')");
        $stmt->bindParam(':company', $companyId);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jobOpenings = [];
        $companyDAO = new CompanyDAO();
        foreach ($results as $row) {
            $jobOpening = new JobOpeningModel();
            $jobOpening->setId($row['id']);
            $jobOpening->setTitle($row['title']);
            $jobOpening->setDescription($row['description']);
            $jobOpening->setCompany($row['company_id']);
            $jobOpening->setLocation($row['location']);
            $jobOpening->setContract($row['contract']);
            $jobOpening->setExperience($row['experience']);
            $jobOpening->setLevel($row['level']);
            $jobOpening->setStatus($row['status']);
            $jobOpening->setSalary($row['salary']);

            $company = $companyDAO->findById($row['company_id']);
            $jobOpening->setCompany($company);

            $jobOpenings[] = $jobOpening;
        }
        return $jobOpenings;
    }

    public function findByContract($contract) {
        $stmt = $this->pdo->prepare("SELECT * FROM job_opening WHERE (contract = :contract AND status = 'active')");
        $stmt->bindParam(':contract', $contract);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jobOpenings = [];
        $companyDAO = new CompanyDAO();
        foreach ($results as $row) {
            $jobOpening = new JobOpeningModel();
            $jobOpening->setId($row['id']);
            $jobOpening->setTitle($row['title']);
            $jobOpening->setDescription($row['description']);
            $jobOpening->setCompany($row['company_id']);
            $jobOpening->setLocation($row['location']);
            $jobOpening->setContract($row['contract']);
            $jobOpening->setExperience($row['experience']);
            $jobOpening->setLevel($row['level']);
            $jobOpening->setStatus($row['status']);
            $jobOpening->setSalary($row['salary']);

            $company = $companyDAO->findById($row['company_id']);
            $jobOpening->setCompany($company);

            $jobOpenings[] = $jobOpening;
        }
        return $jobOpenings;
    }

    public function findBySearch($search, $contract) {
        $searchTerm = "%" . strtolower($search) . "%";
        $contract = "%" . strtolower($contract) . "%";

        $stmt = $this->pdo->prepare("SELECT * FROM job_opening j INNER JOIN company c on c.id = j.company_id WHERE (LOWER(j.title) LIKE :searchTerm OR LOWER(j.location) LIKE :searchTerm OR LOWER(c.name) LIKE :searchTerm) AND j.contract LIKE :contract AND j.status = 'active'");
        $stmt->bindParam(':searchTerm', $searchTerm);
        $stmt->bindParam(':contract', $contract);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jobOpenings = [];
        $companyDAO = new CompanyDAO();

        foreach ($results as $row) {
            $jobOpening = new JobOpeningModel();
            $jobOpening->setId($row['id']);
            $jobOpening->setTitle($row['title']);
            $jobOpening->setDescription($row['description']);
            $jobOpening->setCompany($row['company_id']);
            $jobOpening->setLocation($row['location']);
            $jobOpening->setContract($row['contract']);
            $jobOpening->setExperience($row['experience']);
            $jobOpening->setLevel($row['level']);
            $jobOpening->setStatus($row['status']);
            $jobOpening->setSalary($row['salary']);

            $company = $companyDAO->findById($row['company_id']);
            $jobOpening->setCompany($company);

            $jobOpenings[] = $jobOpening;
        }
        return $jobOpenings;
    }

    public function changeVisibilityById($id) {
        $stmt = $this->pdo->prepare("UPDATE job_opening SET status = IF(status = 'active', 'inactive', 'active') WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function create(JobOpeningModel $jobOpening) {
        $stmt = $this->pdo->prepare("INSERT INTO job_opening (title, company_id, contract, location, level, experience, salary, description, publisher_id) VALUES (:title, :company, :contract, :location, :level, :experience, :salary, :description, :publisher)");

        $title = $jobOpening->getTitle();
        $company = $jobOpening->getCompanyId();
        $contract = $jobOpening->getContract();
        $location = $jobOpening->getLocation();
        $level = $jobOpening->getLevel();
        $experience = $jobOpening->getExperience();
        $salary = $jobOpening->getSalary();
        $description = $jobOpening->getDescription();
        $publisher = $jobOpening->getPublisherId();

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':contract', $contract);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':experience', $experience);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':publisher', $publisher);

        return $stmt->execute();
    }

}