<?php

/**
 * A Migration. [Abstract]
 */
abstract class Migration 
{
    /**
     * Tables to be created this migration
     */
    private $new_tables = array();
    
    /**
     * Create new table
     * @param string a name for our new table
     * @return mixed the new table [for adding columns]
     */
    function create_table($name)
    {
        $tbl = new Ddl_Table($name);
        $this->new_tables []= $tbl;
        return $tbl;
    }
    
    /*
     * for testing...
     */
    function get_new_tables()
    {
        return $this->new_tables;
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