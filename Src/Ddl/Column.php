<?php

/**
 * A db column
 */
class Ddl_Column
{
    private $name, $type;
    
    /**
     * Creates a new table column
     *
     * @param $name string the column name
     * @param $type string the type of this column [eg. int, text, etc.]
     */
    function Ddl_Column($name, $type)
    {
        $this->name         = $name;
        $this->type         = $type;
    }
    
    function get_name()
    {
        return $this->name;
    }
    
    function get_type()
    {
        return $this->type;
    }
    
    /**
     * Let contained type initialize from extras if necessary
     */
    function handle_extras($extras)
    {
        $this->type->handle_extras($extras);
    }
    
    /**
     * Send unhandled methods to contained type
     *
     * eg. $key->is_auto_incrementing();
     */
    function __call($func, $args)
    {
        return $this->type->{$func}();
    }
}

?>