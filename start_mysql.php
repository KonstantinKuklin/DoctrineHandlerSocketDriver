<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use KonstantinKuklin\DoctrineHandlerSocket\EntityManager\HSEntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
// or if you prefer yaml or XML

// database configuration parameters
$conn = array(
    'dbname' => 'handlersocket',
    'user' => 'root',
//    'password' => 'secret',
    'host' => '127.0.0.1',
    'driver' => 'pdo_mysql',
);


// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

$testEntity = $entityManager->find('KonstantinKuklin\\DoctrineHandlerSocket\\Tests\\Entity\\TestEntity', 1);

$a = 0;