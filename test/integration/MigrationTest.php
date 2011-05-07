<?php

/*
 * Somebody other than the tests is going to have to load bootstrap
 * [Eventually this will be migration runner]
 */
include 'config/bootstrap.php';

class TestMigration_Good1 extends Migration 
{
    function up()
    {
        $t = $this->create_table('A');
    }
    
    function down() {}
}

class TestMigration_Good2 extends Migration
{
    function up()
    {
        $t = $this->create_table('A');
        $t->integer('col1');
        $t->set_primary_key(array('id', 'col1'));
    }
    
    function down() {}
}

class TestMigration_Good3 extends Migration
{
    function up()
    {
        $t = $this->create_table('A');
        $t->integer('col1');
    }
    
    function down() {}
}

class TestMigration_Bad extends Migration
{
    function up()
    {
        $t = $this->create_table('B');

        // recall new tables get primary key 'id' unless otherwise
        // specified...
        // second primary key should fail
        $t->integer('col1', array('primary' => true));
    }
    
    function down() {}
}


class MigrationTest extends PHPUnit_Framework_TestCase
{
    function test_create_table()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $this->assertTrue(1 == count($m->get_new_tables()), 'Expect 1 table should be created');
        $tables = $m->get_new_tables();
        $this->assertEquals('A', $tables[0]->get_name());
    }
    
    function test_create_column()
    {
        $m = new TestMigration_Good3();
        $m->up();

        $tables = $m->get_new_tables();
        $this->assertTrue(2 == count($tables[0]->get_columns()));
        $columns = $tables[0]->get_columns();
        $this->assertEquals('col1', $columns[1]->get_name());
        $this->assertEquals('Ddl_Mysql_Integer', get_class($columns[1]->get_type()));
    }
    
    function test_default_integer_type_should_be_int11()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $tables = $m->get_new_tables();
        $columns = $tables[0]->get_columns();
        $type = $columns[0]->get_type();
        $this->assertEquals('medium', $type->get_limit());
        $this->assertRegexp('/int\(11\)/', (string)$type);
    }
    
    function test_set_primary_key()
    {
        $m = new TestMigration_Good1();
        $m->up();

        $tables = $m->get_new_tables();
        $columns = $tables[0]->get_columns();
        $key = $tables[0]->get_primary_key();
        $this->assertEquals('id', $key[0]->get_name());
    }
    
    function test_setting_second_primary_key_on_table_fails()
    {
        $m = new TestMigration_Bad();
        try {
            $m->up();
        } catch (Exception $ex) {
            return;
        }
        $this->fail('Expect setting 2 columns primary throws an exception');
    }
    
    function test_compound_primary_keys()
    {
        $m = new TestMigration_Good2();
        $m->up();
        
        $tables = $m->get_new_tables();
        $key = $tables[0]->get_primary_key();
        $this->assertTrue(is_array($key), 'Expect primary key is array type');
        $this->assertTrue(2 == count($key), 'Expect 2 columns for primary key');
        $this->assertEquals('id', $key[0]->get_name());
        $this->assertEquals('col1', $key[1]->get_name());
    }
    
    function test_create_table_auto_creates_primarykey_id()
    {
        $m = new TestMigration_Good1();
        $m->up();
        
        $tables = $m->get_new_tables();
        $key = $tables[0]->get_primary_key();
        $this->assertEquals('id', $key[0]->get_name());
    }
}

?>