<?php

/**
 * A db table
 */
class Ddl_Table
{
    private $name;

    private $columns = array();
    private $primary_key = array();
    private $foreign_keys = array();
    
    function __construct($name)
    {
        $this->name = $name;
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

        // add defaults for options not specified in args
        $options = array();
        if (isset($args[1])) {
            $options = $args[1];
        }
        $options['primary'] = isset($options['primary']) ? $options['primary'] : false;
        
        $klass = 'Ddl_Mysql_' . ucfirst($type);
        $this->add_column(new Ddl_Column($name, new $klass), $options['primary']);
        
        return $this;
    }
    
    /**
     * Returns this table's primary key column
     * @return $array an array of columns set as this table's primary key
     */
    public function get_primary_key()
    {
        return $this->primary_key;
    }
    
    private function add_column($col, $primary)
    {
        $this->columns []= $col;
        if ($primary) {
            if (!empty($this->primary_key)) {
                throw new Exception('Table can\'t have more than 1 primary key');
            }
            $this->primary_key []= $col;
        }
    }
    
    /**
     * Sets primary key for table (Key can be compound or 1 column.)
     */
    function set_primary_key($key_columns)
    {
        if (empty($key_columns)) {
            return;
        }
        
        if (is_array($key_columns)) {
            $this->primary_key = array();
            foreach ($key_columns as $key_column) {
                $this->primary_key []= $this->get_column($key_column);
            }
        } else {
            $key_column = $key_columns;
            $this->primary_key []= $this->get_column($key_column);
        }
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
}

?>