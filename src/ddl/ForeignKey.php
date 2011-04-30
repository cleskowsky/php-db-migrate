<?php

class Ddl_ForeignKey
{
    private $referenceColumn, $referenceTable;
    private $localColumn;
    
    function __construct($localColumn)
    {
        $this->localColumn = $localColumn;
    }
    
    function references($table, $column)
    {
        $this->referenceTable = $table;
        $this->referenceColumn = $column;
    }
    
    function getReferenceTable()
    {
        return $this->referenceTable;
    }
    
    function getReferenceColumn()
    {
        return $this->referenceColumn;
    }
    
    function getLocalColumn()
    {
        return $this->localColumn->getName();
    }
}

?>