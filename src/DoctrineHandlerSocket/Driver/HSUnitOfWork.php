<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Driver;

use KonstantinKuklin\DoctrineHandlerSocket\Driver\Driver as HSDriver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\UnitOfWork;
use KonstantinKuklin\DoctrineHandlerSocket\Persister\HSBasicEntityPersister;

class HSUnitOfWork extends UnitOfWork
{
    /**
     * The entity persister instances used to persist entity instances.
     *
     * @var array
     */
    private $persisters = array();

    /**
     * The EntityManager that "owns" this UnitOfWork instance.
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Initializes a new UnitOfWork instance, bound to the given EntityManager.
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        parent::__construct($em);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityPersister($entityName)
    {
        $driver = $this->em->getConnection()->getDriver();
        if (!$driver instanceof HSDriver) {
            return parent::getEntityPersister($entityName);
        }


        if (isset($this->persisters[$entityName])) {
            return $this->persisters[$entityName];
        }

        $class = $this->em->getClassMetadata($entityName);

        switch (true) {
            // TODO implement but not now
//            case ($class->isInheritanceTypeNone()):
//                $persister = new Persisters\BasicEntityPersister($this->em, $class);
//                break;
//
//            case ($class->isInheritanceTypeSingleTable()):
//                $persister = new Persisters\SingleTablePersister($this->em, $class);
//                break;
//
//            case ($class->isInheritanceTypeJoined()):
//                $persister = new Persisters\JoinedSubclassPersister($this->em, $class);
//                break;

            default:
                $persister = new HSBasicEntityPersister($this->em, $class);
        }

        $this->persisters[$entityName] = $persister;

        return $this->persisters[$entityName];
    }

    /**
     * {@inheritdoc}
     */
    public function createEntity($className, array $data, &$hints = array())
    {
        $classMetaData = $this->em->getClassMetadata($className);
        //$classMetaData->get
        $normalizedData = array();
        foreach ($data as $key => $value) {
            $newKey = $classMetaData->getFieldName($key);
            $normalizedData[$newKey] = $value;
        }

        return parent::createEntity($className, $normalizedData, $hints);
    }
}