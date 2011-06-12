<?php

require_once 'Autoloader.php';

require_once 'Data/Migration1.php';
require_once 'Data/Migration2.php';

class MigrationTest extends PHPUnit_Framework_TestCase
{
    function test_create_table()
    {
        $m = new Migration1();
        $m->up();

        $this->assertTrue(1 == count($m->get_new_tables()), 'Expect 1 table should be created');
        $tables = $m->get_new_tables();
        $this->assertEquals('A', $tables[0]->get_name());
        
        // new tables get an id primary key field
        $key = $tables[0]->get_primary_key();
        $this->assertEquals('id', $key->get_name());
    }
    
    function test_create_column()
    {
        $m = new Migration1();
        $m->up();

        $tables = $m->get_new_tables();
        $this->assertTrue(2 == count($tables[0]->get_columns()));
        $columns = $tables[0]->get_columns();
        $this->assertEquals('col1', $columns[1]->get_name());
        $this->assertEquals('Ddl_DataType_Integer', get_class($columns[1]->get_type()));
    }
    
    function test_default_integer_type_should_be_int()
    {
        $m = new Migration1();
        $m->up();

        $tables = $m->get_new_tables();
        $columns = $tables[0]->get_columns();
        $type = $columns[0]->get_type();
        $this->assertEquals('medium', $type->get_limit());
        $this->assertRegexp('/int/', (string)$type);
    }
    
    function test_compound_primary_keys()
    {
        $m = new Migration2();
        $m->up();
        
        $tables = $m->get_new_tables();
        $key = $tables[0]->get_primary_key();
        $this->assertTrue(is_array($key), 'Expect primary key is array type');
        $this->assertTrue(2 == count($key), 'Expect 2 columns for primary key');
        $this->assertEquals('col1', $key[0]->get_name());
        $this->assertEquals('col2', $key[1]->get_name());
    }
    
    function test_primary_key_id_is_autoincrementing()
    {
        $m = new Migration1();
        $m->up();
        
        $tables = $m->get_new_tables();
        $key = $tables[0]->get_primary_key();
        $this->assertTrue($key->is_auto_incrementing(), 'Expect primary key id is auto_incrementing');
    }
}

?>