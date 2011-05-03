<?php

abstract class Ddl_Mysql_Base
{
    var $limit;
    
    /**
     * Supplied by subclasses
     */
    protected $mysql_types = array();
    
    function __construct($limit = 'medium')
    {
        $this->limit = $limit;
    }
    
    function get_limit()
    {
        return $this->limit;
    }
    
    function __toString()
    {
        if (isset($this->mysql_types[$this->limit])) {
            return $this->mysql_types[$this->limit];
        }
        return "";
    }
}

?>