<?php

/**
 * MigrationRunner makes changes to a database schema based
 * on migration files provided as input
 *
 * Supported operations: 
 *     create table
 *
 * Key methods: up, down
 */
class MigrationRunner
{
    /*
     * New tables
     */
    private $newTables = array();
    
    /**
     * Create new table
     *
     * @param string a name for our new table
     * @return mixed the new table [for adding columns]
     */
    function createTable($name)
    {
        $this->newTables[] = $name;
    }
    
    /*
     * for testing...
     */
    function _getNewTables()
    {
        return $this->newTables;
    }
}

?>