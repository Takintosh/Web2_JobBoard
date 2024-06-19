<?php

// Import necessary files
require_once '../app/Models/UserModel.php';
require_once '../app/DAO/UserDAO.php';
require_once '../config/csrf.php';

class UserController {
    private $userDAO;

    public function __construct() {
        // Initialize the UserDAO instance
        $this->userDAO = new UserDAO();
    }

    /**
     * Displays the sign-up form for users.
     */
    public function signUp() {
        // Render the sign-up view with the 'user/signup' template
        $this->render('user/signup', 'user', []);
    }

    public function login() {
        // Start a session if one hasn't been started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to home page if user is already logged in
        if (isset($_SESSION['user'])) {
            $_SESSION['message'] = 'You are already logged in';
            $_SESSION['msgType'] = 'alert-info';
            header('Location: /');
            exit();
        }

        // Redirect to home page if email or password fields are empty
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['message'] = 'Email and password are required';
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

        // Attempt to find the user by email
        $user = $this->userDAO->findByEmail($_POST['email']);

        // Verify user credentials and set session variables if valid
        if ($user && password_verify($_POST['password'], $user->getPassword())) {
            // Set user details in session after successful login
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'role' => $user->getRole(),
                'linkedin' => $user->getLinkedin(),
                'picture' => $user->getPicture()
            ];
            $_SESSION['message'] = 'Welcome back, ' . $user->getName();
            $_SESSION['msgType'] = 'alert-success';
            header('Location: /');
        } else {
            // Set error message for invalid login attempt and redirect
            $_SESSION['message'] = 'Invalid email or password';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
        }
        exit();
    }


    public function logout() {
        // Ensure a session is started before attempting to log out
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Validate CSRF token before proceeding with logout
        if (!validateCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Invalid CSRF token';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Clear all session variables
        $_SESSION = array();

        // Delete the session cookie if it exists
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session and redirect to the homepage
        session_destroy();
        header('Location: /');
        exit();
    }

    public function create() {
        // Start a new session for user creation process
        session_start();

        // Instantiate a new UserModel object
        $user = new UserModel();

        // Set user properties from POST data
        $user->setName($_POST['signup-name']);
        $user->setEmail($_POST['signup-email']);

        // Hash the password before storing it
        $user->setPassword(password_hash($_POST['signup-password'], PASSWORD_DEFAULT));

        // Default role for new users is 'user'
        $user->setRole('user');

        // Set LinkedIn profile URL if provided
        $user->setLinkedin($_POST['signup-linkedin']);

        // Process profile picture upload if a file is provided
        if (!empty($_FILES['signup-picture']['name'])) {
            $targetDir = "../public/uploads/users/";
            $targetFile = $targetDir . basename($_FILES["signup-picture"]["name"]);

            // Move uploaded file to target directory
            move_uploaded_file($_FILES["signup-picture"]["tmp_name"], $targetFile);

            // Set the filename in the user object
            $user->setPicture($_FILES['signup-picture']['name']);
        } else {
            // Default picture if none is uploaded
            $user->setPicture("default.png");
        }

        // Attempt to create the user and provide feedback on success/failure
        if ($this->userDAO->create($user)) {
            $_SESSION['message'] = 'User created successfully';
            $_SESSION['msgType'] = 'alert-success';
            header('Location: /');
        } else {
            $_SESSION['error'] = 'Error creating user';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /signup');
        }

        // End the script after redirection
        exit();
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

        // Start output buffering to capture view content
        ob_start();

        // Include the view file for rendering
        require "../app/Views/{$view}.php";

        // Get the buffered content for the view
        $content = ob_get_clean();

        // Include the layout file which uses `$content`
        require "../app/Views/layouts/{$layout}.php";
    }

}