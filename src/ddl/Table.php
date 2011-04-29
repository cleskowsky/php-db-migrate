<?php

/**
 * A db table
 */
class Ddl_Table
{
    private $name;

    private $columns = array();
    private $primaryKey = array();
    
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
     * @param $args array column constraints (eg. limit)
     * @return $mixed return this table for chaining
     */
    function __call($type, $args)
    {
        if (empty($args)) {
            // TODO: should we be raising an exception?
            return $this;
        }
        
        $name = $args[0]; 

        // add defaults for options not specified in args
        $options = array();
        if (isset($args[1])) {
            $options = $args[1];
        }
        $options['primary'] = isset($options['primary']) ? $options['primary'] : false;
        
        $klass = 'Ddl_Mysql_' . ucfirst($type);
        $this->_addColumn(new Ddl_Column($name, new $klass), $options['primary']);
        
        return $this;
    }
    
    /**
     * Returns this table's primary key column
     * @return $array an array of columns set as this table's primary key
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    
    private function _addColumn($col, $primary)
    {
        $this->columns []= $col;
        if ($primary) {
            if (!empty($this->primaryKey)) {
                throw new Exception('Table can\'t have more than 1 primary key');
            }
            $this->primaryKey []= $col;
        }
    }
    
    /**
     * Sets primary key for table (Key can be compound or 1 column.)
     */
    function setPrimaryKey($key_columns)
    {
        if (empty($key_columns)) {
            return;
        }
        
        if (is_array($key_columns)) {
            $this->primaryKey = array();
            foreach ($key_columns as $key_column) {
                $this->primaryKey []= $this->_getColumn($key_column);
            }
        } else {
            $key_column = $key_columns;
            $this->primaryKey []= $this->_getColumn($key_column);
        }
    }
    
    private function _getColumn($name)
    {
        for ($i = 0, $found = false; !$found; $i++) {
            $col = $this->columns[$i];
            if ($name == $col->getName()) {
                return $col;
            }
        }        
    }
}

?>