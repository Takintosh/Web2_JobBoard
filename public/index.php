<?php

// Load routes
$router = require '../config/routes.php';

// Get the request path and HTTP method
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the request
$router->dispatch($method, $path);
