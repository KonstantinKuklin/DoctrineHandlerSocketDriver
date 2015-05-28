<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Tests\Read;

use Doctrine\ORM\Tools\Setup;
use KonstantinKuklin\DoctrineHandlerSocket\Driver\Driver;
use KonstantinKuklin\DoctrineHandlerSocket\EntityManager\HSEntityManager;
use KonstantinKuklin\DoctrineHandlerSocket\Tests\Entity\TestEntity;
use PHPUnit_Framework_TestCase;

class ReadEntityFromSingleTableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var HSEntityManager
     */
    private $em;

    protected function setUp()
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
        // or if you prefer yaml or XML

        // database configuration parameters
        $conn = array(
            'driverClass' => get_class(new Driver()),
            'host' => '127.0.0.1',
            'port' => 9998,
            'auth_key' => 'Password_Read1',
            'dbname' => 'handlersocket'
        );

        // obtaining the entity manager
        $this->em = HSEntityManager::create($conn, $config);
    }

    public function testSimpleRead()
    {
        $entity = $this->em->find('KonstantinKuklin\\DoctrineHandlerSocket\\Tests\\Entity\\TestEntity', 1);

        $testEntity = new TestEntity();

        $testEntity = $this->injectListToObject(
            array(
                'keyAttribute' => 1,
                'dateAttribute' => '0000-00-00',
                'someText' => ''
            ),
            $testEntity
        );

        self::assertEquals($testEntity, $entity);
    }

    protected function injectListToObject(array $paramList, $object)
    {
        foreach ($paramList as $key => $value) {
            $reflectionProperty = new \ReflectionProperty($object, $key);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($object, $value);
        }

        return $object;
    }

}