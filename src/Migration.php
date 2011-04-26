<?php

/**
 * Migration base class
 */
abstract class Migration 
{
    /**
     * Tables to be created this migration
     */
    private $newTables = array();
    
    /**
     * Create new table
     * @param string a name for our new table
     * @return mixed the new table [for adding columns]
     */
    function createTable($name)
    {
        $t = new Ddl_Table($name);
        $this->newTables []= $t;
        return $t;
    }
    
    /**
     * For testing...
     */
    function _getNewTables()
    {
        return $this->newTables;
    }

    /**
     * Roll db forward by this migration
     */
    abstract function up();
    
    /**
     * Roll db back [something went wrong?]
     */
    abstract function down();
}

?>