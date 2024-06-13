<?php

require_once 'router.php';
require_once '../app/Controllers/UserController.php';
require_once '../app/Controllers/JobOpeningController.php';
//require_once '../app/Controllers/ApplicationController.php';
require_once '../app/Middlewares/AuthMiddleware.php';
require_once '../app/Middlewares/AdminMiddleware.php';

$router = new Router();

// Authentication routes
#$router->post('/login', [UserController::class, 'login']);
#$router->post('/logout', [UserController::class, 'logout']);

// Routes for guest users
$router->get('/', [JobOpeningController::class, 'index']);
$router->get('/signup', [UserController::class, 'signUp']);
$router->post('/signup', [UserController::class, 'create']);

// Routes for registered users

// Routes for administrators
$router->get('/admin', [JobOpeningController::class, 'adminListJobOpenings'], AdminMiddleware::class);

return $router;
