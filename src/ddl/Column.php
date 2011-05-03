<?php

/**
 * A db column
 */
class Ddl_Column
{
    private $name, $type;
    private $allow_null, $default_value;
    
    /**
     * Creates a new table column
     *
     * @param $name string the column name
     * @param $type string the type of this column [eg. Integer, Text, etc.]
     * @param $allow_null allow null values in this column?
     * @param $default_value set initial value of column if none provided
     */
    function Ddl_Column($name, $type, $allow_null = true, $default_value = null)
    {
        $this->name         = $name;
        $this->type         = $type;
        
        if (is_bool($allow_null)) {
            $this->allow_null = $allow_null;            
        } else {
            throw new Exception('$allow_null must be true or false');
        }
        
        $this->default_value = $default_value;
    }
    
    function get_name()
    {
        return $this->name;
    }
    
    function get_type()
    {
        return $this->type;
    }
    
    function get_allow_null()
    {
        return $this->allow_null;
    }
    
    function get_default_value()
    {
        return $this->default_value;
    }
}

?>