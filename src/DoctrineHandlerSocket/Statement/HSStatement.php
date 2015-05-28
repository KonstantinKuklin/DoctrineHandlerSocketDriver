<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Statement;


use HS\Query\QueryInterface;
use HS\Reader;
use HS\ReaderInterface;
use HS\Writer;
use KonstantinKuklin\DoctrineHandlerSocket\Result\HSResult;

class HSStatement
{

    /**
     * @var Reader|Writer
     */
    private $hsInstance;

    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * @var HSResult
     */
    private $result;

    /**
     * @param ReaderInterface $hsInstance
     * @param QueryInterface  $query
     */
    public function __construct(ReaderInterface $hsInstance, QueryInterface $query)
    {
        $this->hsInstance = $hsInstance;
        $this->query = $query;
    }


    /**
     * Returns the next row of a result set.
     *
     * @param integer|null $fetchMode Controls how the next row will be returned to the caller.
     *                                The value must be one of the PDO::FETCH_* constants,
     *                                defaulting to PDO::FETCH_BOTH.
     *
     * @return mixed The return value of this method on success depends on the fetch mode. In all cases, FALSE is
     *               returned on failure.
     *
     * @see PDO::FETCH_* constants.
     */
    public function fetch($fetchMode = null)
    {
        if (!$this->result) {
            $this->hsInstance->getResultList();

            $resultData = $this->query->getResult()->getData();
            $this->result = new HSResult($resultData);

            $toReturn = $this->result->current();

            return $toReturn;
        }

        $toReturn = $this->result->next();

        return $toReturn;
    }

    public function closeCursor()
    {
        //$this->hsInstance->close();
    }

}