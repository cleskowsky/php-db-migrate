<?php

/**
 * Integer columns
 */
class Ddl_Integer
{
    private $limit = 'medium';
    
    private $mysqlTypes = array(
        'small'  => 'tinyint',
        'medium' => 'int(11)',
        'large'  => 'bigint(20)'
    );
    
    function getLimit()
    {
        return $this->limit;
    }
    
    function __toString()
    {
        return $this->mysqlTypes[$this->limit];
    }
}

?>