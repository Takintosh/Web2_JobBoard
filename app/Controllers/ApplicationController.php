<?php

require_once '../app/Models/ApplicationModel.php';
require_once '../app/DAO/ApplicationDAO.php';
require_once '../app/DAO/JobOpeningDAO.php';
require_once '../config/csrf.php';

class ApplicationController {
    private $applicationDAO;
    private $jobOpeningDAO;

    public function __construct() {
        // Initialize the ApplicationDAO instance
        $this->applicationDAO = new ApplicationDAO();
    }

    /**
     * Displays the application form for users.
     */
    public function apply() {
        // Start a session if one hasn't been started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to home page if user is not logged in
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = 'You must be logged in to apply';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Redirect to home page if job opening ID is not provided
        if (empty($_POST['job_id'])) {
            $_SESSION['message'] = 'Job opening ID is required';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Validate CSRF token and redirect if invalid
        if (!validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Invalid CSRF token';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Create a new application
        $application = new ApplicationModel();
        $application->setJobOpeningId($_POST['job_id']);
        $application->setUserId($_SESSION['user']['id']);

        // Verify if the application already exists
        if ($this->applicationDAO->findByJobOpeningAndUser($application)) {
            $_SESSION['message'] = 'You have already applied for this job opening';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Save the application
        if ($this->applicationDAO->save($application)) {
            $_SESSION['message'] = 'Application submitted successfully';
            $_SESSION['msgType'] = 'alert-success';
            header('Location: /');
        } else {
            $_SESSION['message'] = 'Failed to submit application';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
        }
        exit();
    }

    /**
     * Displays the list of applications for a job opening.
     */
    public function adminListApplications($jobOpeningId)
    {
        // Start a session if one hasn't been started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to job openings list if job opening ID is not provided
        if (empty($jobOpeningId)) {
            $_SESSION['message'] = 'Job opening ID is required';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /admin');
            exit();
        }

        $this->jobOpeningDAO = new JobOpeningDAO();
        $this->companyDAO = new CompanyDAO();
        // Get the list of applications for the job opening
        $applications = $this->applicationDAO->findAllByJobOpening($jobOpeningId);
        $jobOpening = $this->jobOpeningDAO->findById($jobOpeningId);

        // Load the view
        $this->render('admin/applications', 'admin', ['applications' => $applications, 'jobOpening' => $jobOpening]);

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