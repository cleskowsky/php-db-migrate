<?php

/*
 * Somebody other than the tests is going to have to load bootstrap
 * [Possibly an eventual migration runner]
 */
include 'config/bootstrap.php';

class TestMigration_Good1 extends Migration 
{
    function up()
    {
        $t = $this->createTable('A');
        $t->integer('id', array('primary' => true));
    }
    
    function down() {}
}

class TestMigration_Good2 extends Migration
{
    function up()
    {
        $t = $this->createTable('A');
        $t->integer('id');
        $t->integer('col1');
        $t->setPrimaryKey(array('id', 'col1'));
    }
    
    function down() {}
}

class TestMigration_Good3 extends Migration
{
    function up()
    {
        $t = $this->createTable('A');
        $t->integer('id');
        $t->integer('col1');
        $t->setPrimaryKey('id');
    }
    
    function down() {}
}

class TestMigration_Bad extends Migration
{
    function up()
    {
        $t = $this->createTable('B');
        $t->integer('id', array('primary' => true));

        // second primary key
        $t->integer('col1', array('primary' => true));
    }
    
    function down() {}
}


class MigrationTest extends PHPUnit_Framework_TestCase
{
    function testCreateTable()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $this->assertTrue(1 == count($m->_getNewTables()), 'Expect 1 table should be created');
        $tables = $m->_getNewTables();
        $this->assertEquals('A', $tables[0]->getName());
    }
    
    function testCreateColumn()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $tables = $m->_getNewTables();
        $this->assertTrue(1 == count($tables[0]->getColumns()));
        $columns = $tables[0]->getColumns();
        $this->assertEquals('id', $columns[0]->getName());
        $this->assertEquals('Ddl_Mysql_Integer', get_class($columns[0]->getType()));
    }
    
    function testDefaultIntegerTypeShouldBeInt11()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $tables = $m->_getNewTables();
        $columns = $tables[0]->getColumns();
        $type = $columns[0]->getType();
        $this->assertEquals('medium', $type->getLimit());
        $this->assertRegexp('/int\(11\)/', (string)$type);
    }
    
    function testSetPrimaryKey()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $tables = $m->_getNewTables();
        $columns = $tables[0]->getColumns();
        $key = $tables[0]->getPrimaryKey();
        $this->assertEquals('id', $key[0]->getName());
    }
    
    function testSettingSecondPrimaryKeyOnTableFails()
    {
        $m = new TestMigration_Bad();
        try {
            $m->up();
        } catch (Exception $ex) {
            return;
        }
        $this->fail('Expect setting 2 columns primary throws an exception');
    }
    
    function testCompoundPrimaryKeys()
    {
        $m = new TestMigration_Good2();
        $m->up();
        
        $tables = $m->_getNewTables();
        $key = $tables[0]->getPrimaryKey();
        $this->assertTrue(is_array($key), 'Expect primary key is array type');
        $this->assertTrue(2 == count($key), 'Expect 2 columns for primary key');
        $this->assertEquals('id', $key[0]->getName());
        $this->assertEquals('col1', $key[1]->getName());
        
        // set a single key
        $m = new TestMigration_Good3();
        $m->up();

        $tables = $m->_getNewTables();
        $key = $tables[0]->getPrimaryKey();
        $this->assertEquals('id', $key[0]->getName());
    }
}

?>