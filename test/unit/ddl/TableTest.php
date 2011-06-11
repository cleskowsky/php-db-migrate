<?php

class Ddl_TableTest extends PHPUnit_Framework_TestCase
{
    function test_set_foreign_key()
    {
        $t = new Ddl_Table('A');
        $t->integer('col1_id');
        $t->key('col1_id')->references('B', 'col1');
        
        $keys = $t->get_keys();
        $this->assertTrue(is_array($keys), 'Expect keys should be an array');
        $this->assertTrue(1 == count($keys), 'Expect 1 foreign key should be created');
        $this->assertEquals('col1_id', $keys[0]->get_my_column());
    }
    
    function test_custom_primary_key_without_defining_key_columns()
    {
        $t = new Ddl_Table('A', $primary_key = array('col1', 'col2'));
        $t->integer('col1');
        // don't specify col2
        // $t->string('col2');
        $this->assertFalse($t->validates(), 'Expect all custom key columns to be defined');        
    }
    
    function test_add_single_column_index()
    {
        $t = new Ddl_Table('A');
        $t->integer('col1', array('indexed' => true));
        
        $indexes = $t->get_indexes();
        $this->assertTrue(is_array($indexes), 'Expect indexes should be an array');
        $this->assertTrue(1 == count($indexes), 'Expect 1 index should be created');
        $this->assertEquals('col1', $indexes[0]->get_name());
    }
    
    function test_add_multicolumn_index()
    {
        // add 2 columns via add_index method
        $t = new Ddl_Table('A');
        $t->integer('col1');
        $t->integer('col2');
        $t->add_index(array('col1', 'col2'));
        
        $indexes = $t->get_indexes();
        $this->assertTrue(1 == count($indexes), 'Expect 1 index should be created');
        $this->assertTrue(2 == count($indexes[0]), 'Index should contain 2 columns');
        
        $col = $indexes[0][0];
        $this->assertEquals('col1', $col->get_name());
        $col = $indexes[0][1];
        $this->assertEquals('col2', $col->get_name());
        
        // add 1 column via add_index method
        $t = new Ddl_Table('A');
        $t->integer('col1');
        $t->add_index('col1');
        $indexes = $t->get_indexes();
        $this->assertTrue(1 == count($indexes), 'Expect 1 index should be created');
        $this->assertEquals('col1', $indexes[0]->get_name());
    }
    
    function test_add_index_to_nonexistent_column()
    {
        $t = new Ddl_Table('A');
        try {
            $t->add_index('col1');            
        } catch (Exception $ex) {
            return;
        }
        
        $this->fail('Expect exception is raised. Can\'t create an index on non-existent column');
    }
}

?>