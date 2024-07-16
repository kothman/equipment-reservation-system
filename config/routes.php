<?php
/**
 * config/routes.php
 * 
 * Define all routes for the web app here.
 * 
 * @return \Kothman\ERS\Router
 */
namespace Kothman\ERS;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->match('GET', '/', Controller::class, 'index', 'index.html');
$router->match('GET', '/login', Controller::class, 'index', 'index.html');
$router->match('GET', '/logout', Controller::class, 'index', 'index.html');
$router->group('/users', function() use ($router) {
    $router->match('GET', '/', UserController::class, 'index', 'users/index.html');
    $router->match('GET', '/create/', UserController::class, 'showCreate', 'users/create.html');
    $router->match('POST', '/create/', UserController::class, 'handleCreate', 'users/show.html');
    $router->match('GET', '/([\w]+)(/)?', UserController::class, 'showUser', 'users/show.html');
});

return $router;
