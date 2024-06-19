<?php

// AdminMiddleware class definition
class AdminMiddleware {
    // The handle method checks if the user is an admin.
    public function handle() {
        // Start a session (if not already started)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the 'user' key exists in the session and if the user role is 'admin'
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            // If not an admin, redirect to the login page
            $_SESSION['message'] = 'You must be an administrator to access this page.';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit(); // Exit the script
        }
    }
}
