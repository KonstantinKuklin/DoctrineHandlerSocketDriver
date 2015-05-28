<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Persister;


use Doctrine\ORM\Persisters\BasicEntityPersister;
use Doctrine\ORM\Query;
use HS\Component\Comparison;
use HS\Reader;
use HS\Writer;
use KonstantinKuklin\DoctrineHandlerSocket\Statement\HSStatement;

class HSBasicEntityPersister extends BasicEntityPersister
{
    /**
     * Loads an entity by a list of field criteria.
     *
     * @param array $criteria     The criteria by which to load the entity.
     * @param object|null $entity The entity to load the data into. If not specified, a new entity is created.
     * @param array|null $assoc   The association that connects the entity to load to another entity, if any.
     * @param array $hints        Hints for entity creation.
     * @param int $lockMode
     * @param int|null $limit     Limit number of results.
     * @param array|null $orderBy Criteria to order by.
     *
     * @return object|null The loaded and managed entity instance or NULL if the entity can not be found.
     *
     * @todo Check identity map? loadById method? Try to guess whether $criteria is the id?
     */
    public function load(
        array $criteria, $entity = null, $assoc = null, array $hints = array(), $lockMode = 0, $limit = null,
        array $orderBy = null
    ) {
        /** @var Reader|Writer $hs */
        $hs = $this->conn->getDriver()->getHSConnection();

//        $this->getClassMetadata()->setAssociationOverride()

        // criteria set without normalization and it presented like attribute name
        $criteriaNormalizedList = array();
        foreach ($criteria as $key => $value) {
            $criteriaNormalizedList[] = $this->getClassMetadata()->getColumnName($key);
        }

        $fieldNameList = $this->getClassMetadata()->getColumnNames();
        $indentifier = $this->getClassMetadata()->getSingleIdentifierColumnName();
        $tableName = $this->getClassMetadata()->getTableName();

        $tableMetaData = $this->getClassMetadata()->table;
        if (!$tableMetaData['indexes']) {
            throw new \UnexpectedValueException('Table doesn`t have any described indexes, HS protocol can`t work.');
        }
// TODO work with indexes
        $criteriaKeyList = array_keys($criteria);
//        if($criteriaKeyList) {
//            foreach($criteriaKeyList as $key => $value) {
//                // numeric = user didn`t choice any column to use in where clause
//                if(!is_numeric($key)) {
//                    // user used some column in where clause
//                }
//            }
//        }

        // TODO now I will get first valid index
        $indexList = $tableMetaData['indexes'];
        $index = 'PRIMARY'; // default value
        foreach ($indexList as $indexKey => $columnList) {
            if (in_array($criteriaKeyList[0], $columnList['columns'])) {
                $index = $indexKey;
            }
        }

        $dbName = $this->conn->getDriver()->getDbname($this->conn);
        // TODO need to implement db
        $selectQuery = $hs->select(
            array_values($fieldNameList),
            $dbName,
            $tableName,
            $index,
            Comparison::EQUAL,
            array_values($criteria)
        );

        $this->rsm = new Query\ResultSetMapping();
        $this->rsm->addEntityResult($this->class->name, 'r'); // r for root

        foreach ($fieldNameList as $key => $value) {
            $aliasName = $this->getClassMetadata()->getFieldName($value);
            $this->rsm->addFieldResult('r', $value, $aliasName);
        }

        $stmt = new HSStatement($hs, $selectQuery);

        $hydrator = $this->em->newHydrator($this->selectJoinSql ? Query::HYDRATE_OBJECT : Query::HYDRATE_SIMPLEOBJECT);
        $entities = $hydrator->hydrateAll($stmt, $this->rsm, $hints);

        return $entities ? $entities[0] : null;
    }
}