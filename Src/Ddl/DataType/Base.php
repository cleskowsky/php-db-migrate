<?php

abstract class Ddl_DataType_Base
{
    protected $default_limits = array();
    protected $limit;
    
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
        if (isset($this->default_limits[$this->limit])) {
            return $this->default_limits[$this->limit];
        }
        return "";
    }
    
    /**
     * Subclasses may not need to override this. (Called by column on
     * add.)
     */
    function handle_extras($extras) {}
}

?>