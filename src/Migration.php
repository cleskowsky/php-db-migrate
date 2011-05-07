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
     * @param $name a name for our new table
     * @param $args override migration-assistant defaults for new tables
     * @return the new table [for adding columns]
     */
    function create_table($name, $args = array())
    {        
        if (!empty($args) and isset($args['primary_key'])) {
            $tbl = new Ddl_Table($name, $args['primary_key']);
        } else {
            $tbl = new Ddl_Table($name, array('id'));
            $tbl->integer('id');
        }
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