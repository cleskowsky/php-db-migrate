<?php

/**
 * DbMigrate makes database changes as defined by implementors
 * of this class
 *
 * Key methods: up, down
 */
class DbMigrate
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