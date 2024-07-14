<?php
// db.php
// (Called in boostrap.php)
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . '/../src/Models'),
    isDevMode: true,
);

// configuring the database connection
// https://www.doctrine-project.org/projects/doctrine-dbal/en/current/reference/configuration.html
$connection = DriverManager::getConnection([
    'driver' => 'pgsql',
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);

return $entityManager;
