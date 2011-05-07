<?php

class Ddl_TableTest extends PHPUnit_Framework_TestCase
{
    function test_set_foreign_key()
    {
        $t = new Ddl_Table('A');
        $t->integer('col1_id');
        
        $t->key('col1_id')->references('B', 'col1');
        $this->assertTrue(1 == count($t->_getKeys()), 'Expect 1 foreign key should be created');
    }
    
    function test_custom_primary_key_without_defining_key_columns()
    {
        $t = new Ddl_Table('A', $primary_key = array('col1', 'col2'));
        $t->integer('col1');
        // don't specify col2
        // $t->string('col2');
        $this->assertFalse($t->validates(), 'Expect all custom key columns to be defined');        
    }
}

?>