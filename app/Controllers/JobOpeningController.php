<?php

class JobOpeningController {

    public function __construct() {
        // Initialize session
        session_start();
    }

    /**
     * Home page - Displays a list of job openings for users.
     */
    public function index() {
        $this->render('user/home', 'user');
    }

    /**
     * Admin page - Displays a list of job openings for administrators.
     */
    public function adminListJobOpenings() {
        echo "List of job openings for the admin";
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
