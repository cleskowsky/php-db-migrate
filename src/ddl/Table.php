<?php

/**
 * A db table
 *
 * Contains: columns
 */
class Ddl_Table
{
    private $name;
    private $columns = array();
    
    function __construct($name)
    {
        $this->name = $name;
    }
    
    /**
     * Return an array of this table's columns
     * @return array this table's columns (if any)
     */
    function getColumns()
    {
        return $this->columns;
    }
    
    function getName()
    {
        return $this->name;
    }

    /**
     * Creates columns of various types
     * @param $type string the type of column to create
     * @param $options array column constraints (eg. limit)
     * @return $mixed return this table for chaining
     */
    function __call($type, $args)
    {
        if (empty($args)) {
            // TODO: should we be raising an exception?
            return $this;
        }
        
        $name = $args[0]; 
        
        $options = array();
        if (isset($args[1])) {
            $options = $args[1];
        }
        
        $klass = 'Ddl_' . ucfirst($type);
        $this->columns []= new Ddl_Column($name, new $klass);
        
        return $this;
    }
}

?>