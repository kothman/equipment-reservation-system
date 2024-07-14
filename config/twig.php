<?php
/**
 * config/twig.php
 * 
 * Twig templating setup
 * 
 * @return \Twig\Environment
 */
require_once __DIR__ . '/../vendor/autoload.php';

// Import Extension as TwigExtension for clarity
use \Kothman\Twig\Extension as TwigExtension;

/** Define where templates are stored */
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/resources/views');

/**
 * Create the Twig renderer while defining cache location
 * Certain settings will only be enabled if APP_DEBUG is set to 'true' in /.env
 */
$loaderSettings = $_ENV['APP_DEBUG'] ? [
    'cache' => false,
    'auto_reload' => true,
    'debug' => true,
] : [
    'cache' => __DIR__ . '/../cache',
];
$twig = new \Twig\Environment($loader, $loaderSettings);

// Register custom extension to provide access functions for variables like $_GLOBALS and $_ENV
$twig->addExtension(new TwigExtension());

/** example usage:
 *      echo $twig->render('index.html', ['name' => 'Fabien']);
 * The first variable is the template file, and the second variable is an array (aka a map) of key/value pairs.
 * The variable 'name' is accessible within a template via {{ name }}
 * 
 * https://twig.symfony.com/doc/3.x/templates.html
 */
return $twig;
