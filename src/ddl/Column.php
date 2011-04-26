<?php

/**
 * A db column
 *
 * Contains: keys
 */
class Ddl_Column
{
    private $name, $type;
    
    function Ddl_Column($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getType()
    {
        return $this->type;
    }
}

?>