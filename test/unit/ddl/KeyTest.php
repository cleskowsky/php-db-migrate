<?php

class Ddl_KeyTest extends PHPUnit_Framework_TestCase
{
    function test_set_reference_table_on_fk()
    {
        $t = new Ddl_Table('A');
        $t->integer('user_id');
        $columns = $t->get_columns();
        
        $fk = new Ddl_Key($columns[0]);
        $fk->references($table = 'users', $field = 'id');
        $this->assertEquals('users', $fk->get_reference_table());
        $this->assertEquals('id', $fk->get_reference_column());
        $this->assertEquals('user_id', $fk->get_my_column());
    }
}

?>