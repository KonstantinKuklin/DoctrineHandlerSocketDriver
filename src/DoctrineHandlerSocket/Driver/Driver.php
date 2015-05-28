<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Driver;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver as DoctrineDriver;
use HS\Reader;
use HS\Writer;

class Driver implements DoctrineDriver
{
    const HS_DRIVER = 'hs_driver';
    private $dbname;
    private $host;
    private $port;
    private $authKey;
    private $isWritable;

    private $hsInstance;

    /**
     * Attempts to create a connection with the database.
     *
     * @param array       $params        All connection parameters passed by the user.
     * @param string|null $username      The username to use when connecting.
     * @param string|null $password      The password to use when connecting.
     * @param array       $driverOptions The driver options to use when connecting.
     *
     * @return \Doctrine\DBAL\Driver\Connection The database connection.
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {

        if (isset($params['host']) && $params['host'] != '') {
            $this->host = $params['host'];
        }

        if (isset($params['port'])) {
            $this->port = $params['port'];
        }

        if (isset($params['dbname'])) {
            $this->dbname = $params['dbname'];
        }

        if (isset($params['auth_key'])) {
            $this->authKey = $params['auth_key'];
        }

        if (isset($params['is_writable'])) {
            $this->authKey = $params['is_writable'];
        }

        if ($this->isWritable) {
            $this->hsInstance = new Writer($this->host, $this->port, $this->authKey);
        } else {
            $this->hsInstance = new Reader($this->host, $this->port, $this->authKey);
        }
    }

    /**
     * Gets the DatabasePlatform instance that provides all the metadata about
     * the platform this driver connects to.
     *
     * @return \Doctrine\DBAL\Platforms\AbstractPlatform The database platform.
     */
    public function getDatabasePlatform()
    {
        return new Platform();
    }

    /**
     * Gets the SchemaManager that can be used to inspect and change the underlying
     * database schema of the platform this driver connects to.
     *
     * @param \Doctrine\DBAL\Connection $conn
     *
     * @return \Doctrine\DBAL\Schema\AbstractSchemaManager
     */
    public function getSchemaManager(Connection $conn)
    {
        return new SchemaManager($conn, $this->getDatabasePlatform());
    }

    /**
     * Gets the name of the driver.
     *
     * @return string The name of the driver.
     */
    public function getName()
    {
        return self::HS_DRIVER;
    }

    /**
     * Gets the name of the database connected to for this driver.
     *
     * @param \Doctrine\DBAL\Connection $conn
     *
     * @return string The name of the database.
     */
    public function getDbname(Connection $conn)
    {
        return $this->dbname;
    }

    /**
     * @return Reader|Writer
     */
    public function getHSConnection()
    {
        return $this->hsInstance;
    }
}