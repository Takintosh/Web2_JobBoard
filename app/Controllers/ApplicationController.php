<?php

require_once '../app/Models/ApplicationModel.php';
require_once '../app/DAO/ApplicationDAO.php';
require_once '../config/csrf.php';

class ApplicationController {
    private $applicationDAO;

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
}