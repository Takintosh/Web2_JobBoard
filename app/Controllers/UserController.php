<?php

// Import necessary files
require_once '../app/Models/UserModel.php';
require_once '../app/DAO/UserDAO.php';

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
        // Render the sign-up view
        $this->render('user/signup', 'user', []);
    }

    public function login() {
        // Start a session
        session_start();

        // Check if the user is already logged in
        if (isset($_SESSION['user'])) {
            $_SESSION['message'] = 'You are already logged in';
            $_SESSION['msgType'] = 'alert-info';
            header('Location: /');
            exit();
        }

        // Check if the email and password are set and not empty
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['message'] = 'Email and password are required';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
            exit();
        }

        // Find the user by email
        $user = $this->userDAO->findByEmail($_POST['email']);

        // Check if the user exists and the password is correct
        if ($user && password_verify($_POST['password'], $user->getPassword())) {
            // Set the user in the session
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
            $_SESSION['message'] = 'Invalid email or password';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /');
        }
        exit();
    }

    public function logout() {
        // Start the session if it has not already been started
        session_start();

        // Unset all of the session variables
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie
        // Note: This will destroy the session, and not just the session data
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session
        session_destroy();

        // Redirect to the homepage or login page
        header('Location: /');
        exit();
    }


    public function create() {
        // Start a session
        session_start();

        // Create a new UserModel instance
        $user = new UserModel();
        $user->setName($_POST['signup-name']);
        $user->setEmail($_POST['signup-email']);
        $user->setPassword(password_hash($_POST['signup-password'], PASSWORD_DEFAULT));
        $user->setRole('user');
        $user->setLinkedin($_POST['signup-linkedin']);

        // Handle profile picture upload
        if (!empty($_FILES['signup-picture']['name'])) {
            $targetDir = "../public/uploads/users/";
            $targetFile = $targetDir . basename($_FILES["signup-picture"]["name"]);
            move_uploaded_file($_FILES["signup-picture"]["tmp_name"], $targetFile);
            $user->setPicture($_FILES['signup-picture']['name']);
        } else {
            $user->setPicture("default.png");
        }

        // Create the user and handle success/failure
        if ($this->userDAO->create($user)) {
            $_SESSION['message'] = 'User created successfully';
            $_SESSION['msgType'] = 'alert-success';
            header('Location: /');
        } else {
            $_SESSION['error'] = 'Error creating user';
            $_SESSION['msgType'] = 'alert-danger';
            header('Location: /signup');
        }
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
        ob_start();
        require "../app/Views/{$view}.php";
        $content = ob_get_clean();
        require "../app/Views/layouts/{$layout}.php";
    }
}