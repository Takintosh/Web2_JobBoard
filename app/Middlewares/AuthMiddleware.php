<?php

// AuthMiddleware class definition
class AuthMiddleware {
    // The handle method checks if a user is authenticated.
    public function handle() {
        // Start a session (if not already started)
        session_start();

        // Check if the 'user' key exists in the session
        if (!isset($_SESSION['user'])) {
            // If not authenticated, redirect to the login page
            header('Location: /login');
            exit(); // Exit the script
        }
    }
}
