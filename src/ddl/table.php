<?php

/**
 * A db table
 */
class Ddl_Table
{
    private $name, $primary_key;

    private $columns = array();
    private $foreign_keys = array();
    
    /**
     * Creates a new db table
     * @param $name the table of this new table
     * @param $primary_key an array of column names representing this table's
     *        primary key
     */
    function __construct($name, $primary_key = array())
    {
        $this->name = $name;
        $this->primary_key = $primary_key;
    }
    
    /**
     * @return an array of this table's columns (if any)
     */
    function get_columns()
    {
        return $this->columns;
    }
    
    function get_name()
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

        $klass = 'Ddl_Mysql_' . ucfirst($type);
        $col = new Ddl_Column($name, new $klass);
        $this->columns []= $col;

        // is column part of table's primary key?
        $index = array_search($name, $this->primary_key, true);
        if (false !== $index) {
            $this->primary_key[$index] = $col;
        }
        
        return $this;
    }
    
    /**
     * Returns this table's primary key column
     * @return an array of columns set as this table's primary key
     */
    public function get_primary_key()
    {
        return $this->primary_key;
    }
    
    private function get_column($name)
    {
        for ($i = 0, $found = false; !$found; $i++) {
            $col = $this->columns[$i];
            if ($name == $col->get_name()) {
                return $col;
            }
        }
    }
    
    /**
     * Creates a new foreign key on this table and returns it. 
     * Note: A call to key() _must_ always be followed by a call to references()
     *       eg. $fk->key('user_id')->references('users', 'id');
     * @param $name name of key column
     * @return the new foreign key
     */
    function key($name)
    {
        $col = $this->get_column($name);
        $key = new Ddl_Key($col);
        $this->foreign_keys = $key;
        return $key;
    }
    
    function validates()
    {
        return $this->_verify_all_primary_key_columns_defined();
    }
    
    private function _verify_all_primary_key_columns_defined()
    {
        if (empty($this->primary_key)) {
            return true;
        }
        
        foreach ($this->primary_key as $key) {
            if (is_string($key)) {
                return false;
            }
        }
        return true;
    }
}

?>