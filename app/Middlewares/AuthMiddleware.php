<?php

// AuthMiddleware class definition
class AuthMiddleware {
    // The handle method checks if a user is authenticated.
    public function handle() {
        // Start a session (if not already started)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the 'user' key exists in the session
        if (!isset($_SESSION['user'])) {
            // If not authenticated, redirect to the login page
            $_SESSION['message'] = 'You must be logged in to access this page.';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit(); // Exit the script
        }
    }
}
