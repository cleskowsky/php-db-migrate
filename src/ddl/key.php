<?php

class Ddl_Key
{
    private $reference_column, $reference_table;
    private $local_column;
    
    function __construct($local_column)
    {
        $this->local_column = $local_column;
    }
    
    function references($table, $column)
    {
        $this->reference_table = $table;
        $this->reference_column = $column;
    }
    
    function get_reference_table()
    {
        return $this->reference_table;
    }
    
    function get_reference_column()
    {
        return $this->reference_column;
    }
    
    function get_local_column()
    {
        return $this->local_column->get_name();
    }
}

?>