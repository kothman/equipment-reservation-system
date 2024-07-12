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

$router->match('GET', '/', Controllers\Controller::class, 'base.template.html');

return $router;