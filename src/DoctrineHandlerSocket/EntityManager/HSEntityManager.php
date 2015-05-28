<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\EntityManager;


use Doctrine\Common\EventManager;
use Doctrine\ORM\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use KonstantinKuklin\DoctrineHandlerSocket\Driver\HSUnitOfWork;

class HSEntityManager extends EntityManager
{
    /**
     * Factory method to create EntityManager instances.
     *
     * @param mixed         $conn         An array with the connection parameters or an existing Connection instance.
     * @param Configuration $config       The Configuration instance to use.
     * @param EventManager  $eventManager The EventManager instance to use.
     *
     * @return EntityManager The created EntityManager.
     *
     * @throws \InvalidArgumentException
     * @throws ORMException
     */
    public static function create($conn, Configuration $config, EventManager $eventManager = null)
    {
        if ( ! $config->getMetadataDriverImpl()) {
            throw ORMException::missingMappingDriverImpl();
        }

        switch (true) {
            case (is_array($conn)):
                $conn = \Doctrine\DBAL\DriverManager::getConnection(
                    $conn, $config, ($eventManager ?: new EventManager())
                );
                break;

            case ($conn instanceof Connection):
                if ($eventManager !== null && $conn->getEventManager() !== $eventManager) {
                    throw ORMException::mismatchedEventManager();
                }
                break;

            default:
                throw new \InvalidArgumentException("Invalid argument: " . $conn);
        }

        $entityManager = new EntityManager($conn, $config, $conn->getEventManager());

        // create custom unit of work
        $customUnitOfWork = new HSUnitOfWork($entityManager);

        // injecting
        $reflectionProperty = new \ReflectionProperty($entityManager, 'unitOfWork');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($entityManager, $customUnitOfWork);

        $entityManager->getConnection()->connect();

        return $entityManager;
    }
}