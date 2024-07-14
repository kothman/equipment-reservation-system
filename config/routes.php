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

return $router;
