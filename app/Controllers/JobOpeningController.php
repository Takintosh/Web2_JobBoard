<?php

require_once '../app/DAO/JobOpeningDAO.php';

class JobOpeningController {
    private $jobOpeningDAO;
    private $companyDAO;

    public function __construct() {
        $this->jobOpeningDAO = new JobOpeningDAO();
    }

    /**
     * Home page - Displays a list of job openings for users.
     */
    public function index() {
        $jobOpenings = $this->jobOpeningDAO->findAllActive();
        $this->companyDAO = new CompanyDAO();
        $companies = $this->companyDAO->findAll();
        $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies]);
    }

    /**
     * Admin page - Displays a list of job openings for administrators.
     */
    public function adminListJobOpenings() {
        $jobOpenings = $this->jobOpeningDAO->findAll();
        $this->render('admin/job_openings', 'admin', ['jobOpenings' => $jobOpenings]);
    }

    public function adminChangeVisibility($jobOpeningId) {

        // Start a session if one hasn't been started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Validate CSRF token and redirect if invalid
        if (!validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Invalid CSRF token';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /admin');
            exit();
        }

        // Code to change status
        if($this->jobOpeningDAO->changeVisibilityById($jobOpeningId)) {
            $_SESSION['message'] = 'Visibility changed successfully';
            $_SESSION['msgType'] = 'alert-success';
        } else {
            $_SESSION['message'] = 'Error changing visibility';
            $_SESSION['msgType'] = 'alert-danger';
        }
        header('Location: /admin');
        exit();
    }

    public function listByCompany($companySlug) {
        // Initialize a new Company Data Access Object (DAO)
        $this->companyDAO = new CompanyDAO();

        // Retrieve company details by its slug
        $company = $this->companyDAO->findBySlug($companySlug);

        // If the company is not found, store an error message and redirect to the homepage
        if(!$company) {
            $_SESSION['message'] = 'Company not found';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        } else {
            // If the company is found, get its ID and retrieve all job openings for that company
            $companyId = $company->getId();
            $jobOpenings = $this->jobOpeningDAO->findByCompany($companyId);

            // Retrieve all companies to display
            $companies = $this->companyDAO->findAll();

            // Render the user home page with the job openings and companies data
            $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies, 'company' => $company]);
        }
    }

    public function listByContract($contract) {
        // Retrieve all job openings by contract type
        $jobOpenings = $this->jobOpeningDAO->findByContract($contract);

        // Initialize a new Company DAO to retrieve all companies
        $this->companyDAO = new CompanyDAO();
        $companies = $this->companyDAO->findAll();

        // Render the user home page with the job openings and companies data, filtered by contract type
        $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies, 'contract' => $contract]);
    }


    public function search() {
        // Start a session if one hasn't been started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Validate the CSRF token; if it's invalid, store an error message in the session and redirect to the homepage
        if (!validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Invalid CSRF token';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Retrieve search parameters from POST request
        $searchText = $_POST['search-text'];
        $contract = $_POST['contract'];

        // Perform a search for job openings based on the provided search text and contract type
        $jobOpenings = $this->jobOpeningDAO->findBySearch($searchText, $contract);

        // Initialize a new Company DAO to retrieve all companies
        $this->companyDAO = new CompanyDAO();
        $companies = $this->companyDAO->findAll();

        // Render the user home page with the job openings and companies data, based on the search results
        $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies]);
    }

    public function newJobOpening() {
        // Initialize a new Company DAO to retrieve all companies
        $this->companyDAO = new CompanyDAO();
        $companies = $this->companyDAO->findAll();

        // Render the admin page for creating a new job opening with the list of companies
        $this->render('admin/new_job_opening', 'admin', ['companies' => $companies]);
    }

    public function createJobOpening() {
        // Start a session if one hasn't been started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Validate the CSRF token; if it's invalid, store an error message in the session and redirect to the creation page
        if (!validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Invalid CSRF token';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Create a new Job Opening model and set its properties from POST request data
        $jobOpening = new JobOpeningModel();

        // Set job opening details from form input
        $jobOpening->setTitle($_POST['title']);
        $jobOpening->setCompanyId($_POST['company']);
        $jobOpening->setContract($_POST['contract']);
        $jobOpening->setLocation($_POST['location']);
        $jobOpening->setLevel($_POST['expertise']);
        $jobOpening->setExperience($_POST['experience']);
        $jobOpening->setSalary($_POST['salary']);
        $jobOpening->setDescription($_POST['description']);
        $jobOpening->setPublisherId($_POST['publisher']);

        // Attempt to create a new job opening in the database
        // If successful, store a success message in the session and redirect to the admin page
        // If not, store an error message and redirect to the job opening creation page
        if($this->jobOpeningDAO->create($jobOpening)) {
            $_SESSION['message'] = 'Job opening created successfully';
            $_SESSION['msgType'] = 'alert-success';
            header('Location: /admin');
        } else {
            $_SESSION['message'] = 'Error creating job opening';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /admin/new-job-opening');
        }

        // End script execution after redirection
        exit();
    }

    public function redirect() {
        header('Location: /');
    }

    /**
     * Renders the specified view within the specified layout.
     *
     * @param string $view   The view file to render.
     * @param string $layout The layout file to use.
     * @param array  $data   Optional data to pass to the view.
     */
    private function render($view, $layout, $data = []) {
        extract($data);
        ob_start();
        require "../app/Views/{$view}.php";
        $content = ob_get_clean();
        require "../app/Views/layouts/{$layout}.php";
    }
}
