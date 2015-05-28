<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use KonstantinKuklin\DoctrineHandlerSocket\EntityManager\HSEntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
// or if you prefer yaml or XML

// database configuration parameters
$conn = array(
    'driverClass' => get_class(new \KonstantinKuklin\DoctrineHandlerSocket\Driver\Driver()),
    'host' => '127.0.0.1',
    'port' => 9998,
    'auth_key' => 'Password_Read1',
    'dbname' => 'handlersocket'
);

// obtaining the entity manager
$entityManager = HSEntityManager::create($conn, $config);

$testEntity = $entityManager->find('KonstantinKuklin\\DoctrineHandlerSocket\\Tests\\Entity\\TestEntity', 1);
$testEntity2 = $entityManager->find('KonstantinKuklin\\DoctrineHandlerSocket\\Tests\\Entity\\TestEntity', 2);
$testEntity3 = $entityManager->find('KonstantinKuklin\\DoctrineHandlerSocket\\Tests\\Entity\\TestEntity', 3);
$testEntity10001 = $entityManager->find('KonstantinKuklin\\DoctrineHandlerSocket\\Tests\\Entity\\TestEntity', 10001);

$a = 0;

