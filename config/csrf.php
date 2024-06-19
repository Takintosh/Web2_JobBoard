<?php
// Start the session if it has not been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to generate a Cross-Site Request Forgery (CSRF) token
function generateCsrfToken() {
    // Check if a CSRF token is already set in the session
    if (empty($_SESSION['csrf_token'])) {
        // Generate a new CSRF token and store it in the session
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// Function to validate a given CSRF token against the one stored in the session
function validateCsrfToken($token) {
    // Return true if a CSRF token is set in the session and it matches the given token
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Call the function to ensure a CSRF token is generated for the session
generateCsrfToken();

?>