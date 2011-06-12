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
     * Creates new table. A primary key field, id, is created by default
     * unless 'primary_key' extra is specified.
     *
     * Eg. create_table('A'); 
     * 
     * Produces: 
     * 
     * create table `A` (
     *     `id` primary key auto_increment
     * ) engine=innodb default character set=utf8;
     *
     * Eg. $t = create_table('B', array('col1', 'col2'));
     *     $t->integer('col1');
     *     $t->integer('col2');
     *
     * Produces:
     *
     * create table `B` (
     *     `col1` int(11) not null,
     *     `col2` int(11) not null,
     *     primary key (`col1`, `col2`)
     * ) engine=innodb default character set=utf8;
     *
     * @param $name a name for our new table
     * @param $args override migration-assistant defaults for new tables
     * @return the new table
     */
    function create_table($name, $args = array())
    {        
        if (!empty($args) and isset($args['primary_key'])) {
            $tbl = new Ddl_Table($name, $args['primary_key']);
        } else {
            $tbl = new Ddl_Table($name, array('id'));
            $tbl->integer('id', array('auto_increment' => true));
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