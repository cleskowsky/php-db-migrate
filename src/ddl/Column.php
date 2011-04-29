<?php

/**
 * A db column
 */
class Ddl_Column
{
    private $name, $type;
    private $notNull, $defaultValue;
    
    /**
     * Creates a new table column
     *
     * @param $name string the column name
     * @param $type string the type of this column [eg. Integer, Text, etc.]
     * @param $notNull allow null values in this column
     * @param $defaultValue set initial value of column if none provided
     */
    function Ddl_Column($name, $type, $notNull = false, $defaultValue = null)
    {
        $this->name         = $name;
        $this->type         = $type;
        
        if (is_bool($notNull)) {
            $this->notNull      = $notNull;            
        } else {
            throw new Exception('$notNull must be true or false');
        }
        
        $this->defaultValue = $defaultValue;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getType()
    {
        return $this->type;
    }
    
    /*
     * for testing...
     */
    function _getNotNull()
    {
        return $this->notNull;
    }
    
    /*
     * for testing...
     */
    function _getDefaultValue()
    {
        return $this->defaultValue;
    }
}

?>