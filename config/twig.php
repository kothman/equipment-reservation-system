<?php
/**
 * config/twig.php
 * 
 * Twig templating setup
 * 
 * @return \Twig\Environment
 */
require_once __DIR__ . '/../vendor/autoload.php';

/** Define where templates are stored */
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/resources/views');

/** Create the Twig renderer while defining cache location */
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache',
]);

/** example usage:
 *      echo $twig->render('index.html', ['name' => 'Fabien']);
 * The first variable is the template file, and the second variable is an array (aka a map) of key/value pairs.
 * The variable 'name' is accessible within a template via {{ name }}
 * 
 * https://twig.symfony.com/doc/3.x/templates.html
 */
return $twig;