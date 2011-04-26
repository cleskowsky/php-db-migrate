<?php

/*
 * Somebody other than the tests is going to have to load bootstrap
 * [Possibly an eventual migration runner]
 */
include 'config/bootstrap.php';

class TestMigration1 extends Migration 
{
    function up()
    {
        // create table
        $t = $this->createTable('A');
        
        // add columns
        $t->integer('id');
    }
    
    function down() {}
}

class MigrationTest extends PHPUnit_Framework_TestCase
{
    function testCreateTable()
    {
        $m = new TestMigration1();
        $m->up();

        $this->assertTrue(1 == count($m->_getNewTables()), 'Expect 1 table should be created');
        $tables = $m->_getNewTables();
        $this->assertEquals('A', $tables[0]->getName());
    }
    
    function testCreateColumn()
    {
        $m = new TestMigration1();
        $m->up();

        $tables = $m->_getNewTables();
        $this->assertTrue(1 == count($tables[0]->getColumns()));
        $columns = $tables[0]->getColumns();
        $this->assertEquals('id', $columns[0]->getName());
        $this->assertEquals('Ddl_Integer', get_class($columns[0]->getType()));
    }
    
    function testDefaultIntegerTypeShouldBeInt11()
    {
        $m = new TestMigration1();
        $m->up();
        
        $tables = $m->_getNewTables();
        $columns = $tables[0]->getColumns();
        $type = $columns[0]->getType();
        $this->assertEquals('medium', $type->getLimit());
        $this->assertRegexp('/int\(11\)/', (string)$type);
    }
}

?>