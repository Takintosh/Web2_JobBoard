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
            $targetDir = "../public/uploads/";
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