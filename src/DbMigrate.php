<?php

/**
 * DbMigrate makes database changes -currently mysql only- as
 * defined by implementors of this class
 *
 * Key methods: up, down
 */
class DbMigrate
{
    /*
     * Tables to be created
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