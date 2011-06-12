<?php

class Ddl_Key
{
    private $reference_column, $reference_table;
    private $my_column;
    
    function __construct($my_column)
    {
        $this->my_column = $my_column;
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
    
    function get_my_column()
    {
        return $this->my_column->get_name();
    }
}

?>