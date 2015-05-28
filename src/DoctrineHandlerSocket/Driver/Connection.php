<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Driver;


use Doctrine\DBAL\Driver\Connection as DoctrineConnection;
use InvalidArgumentException;

class Connection implements DoctrineConnection
{

    /**
     * Prepares a statement for execution and returns a Statement object.
     *
     * @param string $prepareString
     *
     * @return \Doctrine\DBAL\Driver\Statement
     */
    function prepare($prepareString)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Executes an SQL statement, returning a result set as a Statement object.
     *
     * @return \Doctrine\DBAL\Driver\Statement
     */
    function query()
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Quotes a string for use in a query.
     *
     * @param string  $input
     * @param integer $type
     *
     * @return string
     */
    function quote($input, $type = \PDO::PARAM_STR)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Executes an SQL statement and return the number of affected rows.
     *
     * @param string $statement
     *
     * @return integer
     */
    function exec($statement)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the ID of the last inserted row or sequence value.
     *
     * @param string|null $name
     *
     * @return string
     */
    function lastInsertId($name = null)
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Initiates a transaction.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    function beginTransaction()
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Commits a transaction.
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    function commit()
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Rolls back the current transaction, as initiated by beginTransaction().
     *
     * @return boolean TRUE on success or FALSE on failure.
     */
    function rollBack()
    {
        throw new InvalidArgumentException(__FUNCTION__ . ' not supported');
    }

    /**
     * Returns the error code associated with the last operation on the database handle.
     *
     * @return string|null The error code, or null if no operation has been run on the database handle.
     */
    function errorCode()
    {
        // TODO: Implement errorCode() method.
    }

    /**
     * Returns extended error information associated with the last operation on the database handle.
     *
     * @return array
     */
    function errorInfo()
    {
        // TODO: Implement errorInfo() method.
    }
}