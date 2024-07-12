<?php
/**
 * src/bootstrap.php
 * 
 * This file is called by public/index.php, and handles setting up the database, router, passing
 * these objects to the App object, and dispatching the App to handle incoming HTTP requests.
 * 
 * The namespace declaration should always come first, if included.
 */
namespace Kothman\ERS;

/**
 * "/vendor/autoload.php" should always be included immediately after the namespace delcaration
 * (if any) in each PHP file to ensure libraries and local classes are all imported.
 **/
require_once __DIR__ . '/../vendor/autoload.php';

// For debugging
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Get the entity manager object from 'config/db.php'
$entityManager = require_once __DIR__ . '/../config/db.php';

// Get the Twig renderer
$renderer = require_once __DIR__ . '/../config/twig.php';

/**
 * Get the Router object.
 **/
$router = new Router(__DIR__ . '/../config/routes.php');

/**
 * Create the app instance, and pass it anything it might need to handle the incoming request.
 * Things like the router and entitleManager should be setup and passed to the App to keep
 * responsibilities separate. The app generally shouldn't handle setup of objects requiring configuration.
 */
$app = new App($router, $entityManager, $renderer);
/** Finally, call App::run() to handle the server request, after setup is complete.*/
$app->dispatch();

/**
 * Don't end the file with the closing tag ?> so that there is not any trailing whitespace or newlines.
 */