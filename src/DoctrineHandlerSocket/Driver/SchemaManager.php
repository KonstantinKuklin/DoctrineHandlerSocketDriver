<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Driver;


use Doctrine\DBAL\Schema\AbstractSchemaManager;
use InvalidArgumentException;

class SchemaManager extends AbstractSchemaManager
{

    /**
     * Gets Table Column Definition.
     *
     * @param array $tableColumn
     *
     * @return \Doctrine\DBAL\Schema\Column
     */
    protected function _getPortableTableColumnDefinition($tableColumn)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }
}