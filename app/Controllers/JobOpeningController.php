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
        $jobOpenings = $this->jobOpeningDAO->findAll();
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
        $this->companyDAO = new CompanyDAO();
        $company = $this->companyDAO->findBySlug($companySlug);
        if(!$company) {
            $_SESSION['message'] = 'Company not found';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        } else {
            $companyId = $company->getId();
            $jobOpenings = $this->jobOpeningDAO->findByCompany($companyId);
            $companies = $this->companyDAO->findAll();
            $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies, 'company' => $company]);
        }
    }

    public function listByContract($contract) {
        $jobOpenings = $this->jobOpeningDAO->findByContract($contract);
        $this->companyDAO = new CompanyDAO();
        $companies = $this->companyDAO->findAll();
        $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies, 'contract' => $contract]);
    }

    public function search() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Validate CSRF token and redirect if invalid
        if (!validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Invalid CSRF token';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        $searchText = $_POST['search-text'];
        $contract = $_POST['contract'];

        $jobOpenings = $this->jobOpeningDAO->findBySearch($searchText, $contract);
        $this->companyDAO = new CompanyDAO();
        $companies = $this->companyDAO->findAll();
        $this->render('user/home', 'user', ['jobOpenings' => $jobOpenings, 'companies' => $companies]);

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
