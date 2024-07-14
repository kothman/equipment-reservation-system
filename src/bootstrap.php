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

// 'use' is a convenient way to call \Dotenv\Dotenv::createImmutable, without typing out the full namespace.
use Dotenv\Dotenv;

/**
 * "/vendor/autoload.php" should always be included immediately after the namespace delcaration
 * (if any) in each PHP file to ensure libraries and local classes are all imported.
 **/
require_once __DIR__ . '/../vendor/autoload.php';

// For debugging
ini_set('display_errors', 'On');

// Load .env variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Get the entity manager object from 'config/db.php'
$entityManager = require_once __DIR__ . '/../config/db.php';

// Get the Twig renderer
$renderer = require_once __DIR__ . '/../config/twig.php';

/**
 * Get the Router object.
 **/
$router = require_once __DIR__ . '/../config/routes.php';

/**
 * Create the app instance, and pass it anything it might need to handle the incoming request.
 * Things like the router and entitleManager should be setup and passed to the App to keep
 * responsibilities separate. The app generally shouldn't handle setup of objects requiring configuration.
 */
$app = new App($router, $entityManager, $renderer);
/** Finally, call App::dispatch
  () to handle the server request, after setup is complete.*/
$app->dispatch();

/**
 * Don't end the file with the closing tag ?> so that there aren't any trailing whitespace or newlines.
 */
