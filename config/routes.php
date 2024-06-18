<?php

require_once 'router.php';
require_once '../app/Controllers/UserController.php';
require_once '../app/Controllers/JobOpeningController.php';
require_once '../app/Controllers/ApplicationController.php';
require_once '../app/Middlewares/AuthMiddleware.php';
require_once '../app/Middlewares/AdminMiddleware.php';

$router = new Router();

// Authentication routes
$router->post('/login', [UserController::class, 'login']);
$router->post('/logout', [UserController::class, 'logout']);

// Routes for guest users
$router->get('/', [JobOpeningController::class, 'index']);
$router->get('/signup', [UserController::class, 'signUp']);
$router->post('/signup', [UserController::class, 'create']);
$router->get('/company/{slug}', [JobOpeningController::class, 'listByCompany']);

// Routes for registered users
$router->post('/apply', [ApplicationController::class, 'apply'], AuthMiddleware::class);

// Routes for administrators
$router->get('/admin', [JobOpeningController::class, 'adminListJobOpenings'], AdminMiddleware::class);
$router->get('/admin/applications/{jobOpeningId}', [ApplicationController::class, 'adminListApplications'], AdminMiddleware::class);
$router->post('/admin/change-visibility/{jobOpeningId}', [JobOpeningController::class, 'adminChangeVisibility'], AdminMiddleware::class);

return $router;
