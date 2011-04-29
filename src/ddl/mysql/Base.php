<?php

abstract class Ddl_Mysql_Base
{
    var $limit;
    
    function __construct($limit = 'medium')
    {
        $this->limit = $limit;
    }
    
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