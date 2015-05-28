<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace KonstantinKuklin\DoctrineHandlerSocket\Result;


use Iterator;

class HSResult implements Iterator
{

    private $var = array();

    public function __construct(array $array)
    {
        $this->var = $array;
        $this->rewind();
    }

    public function rewind()
    {
        reset($this->var);
    }

    public function current()
    {
        $var = current($this->var);

        return $var;
    }

    public function key()
    {
        $var = key($this->var);

        return $var;
    }

    public function next()
    {
        $var = next($this->var);

        return $var;
    }

    public function valid()
    {
        $key = key($this->var);
        $var = ($key !== null && $key !== false);

        return $var;
    }
}