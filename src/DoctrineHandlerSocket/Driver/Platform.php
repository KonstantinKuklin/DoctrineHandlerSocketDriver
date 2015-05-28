<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Driver;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use InvalidArgumentException;

class Platform extends AbstractPlatform
{
    const HS_PLATFORM = 'hs_platform';

    /**
     * Returns the SQL snippet that declares a boolean column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getBooleanTypeDeclarationSQL(array $columnDef)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the SQL snippet that declares a 4 byte integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getIntegerTypeDeclarationSQL(array $columnDef)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the SQL snippet that declares an 8 byte integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getBigIntTypeDeclarationSQL(array $columnDef)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the SQL snippet that declares a 2 byte integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    public function getSmallIntTypeDeclarationSQL(array $columnDef)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the SQL snippet that declares common properties of an integer column.
     *
     * @param array $columnDef
     *
     * @return string
     */
    protected function _getCommonIntegerTypeDeclarationSQL(array $columnDef)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Lazy load Doctrine Type Mappings.
     *
     * @return void
     */
    protected function initializeDoctrineTypeMappings()
    {
        $this->doctrineTypeMapping = array(
            'tinyint' => 'boolean',
            'smallint' => 'smallint',
            'mediumint' => 'integer',
            'int' => 'integer',
            'integer' => 'integer',
            'bigint' => 'bigint',
            'tinytext' => 'text',
            'mediumtext' => 'text',
            'longtext' => 'text',
            'text' => 'text',
            'varchar' => 'string',
            'string' => 'string',
            'char' => 'string',
            'date' => 'date',
            'datetime' => 'datetime',
            'timestamp' => 'datetime',
            'time' => 'time',
            'float' => 'float',
            'double' => 'float',
            'real' => 'float',
            'decimal' => 'decimal',
            'numeric' => 'decimal',
            'year' => 'date',
            'longblob' => 'blob',
            'blob' => 'blob',
            'mediumblob' => 'blob',
            'tinyblob' => 'blob',
            'binary' => 'binary',
            'varbinary' => 'binary',
            'set' => 'simple_array',
        );
    }

    /**
     * Returns the SQL snippet used to declare a CLOB column type.
     *
     * @param array $field
     *
     * @return string
     */
    public function getClobTypeDeclarationSQL(array $field)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the SQL Snippet used to declare a BLOB column type.
     *
     * @param array $field
     *
     * @return string
     */
    public function getBlobTypeDeclarationSQL(array $field)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Gets the name of the platform.
     *
     * @return string
     */
    public function getName()
    {
        return self::HS_PLATFORM;
    }
}