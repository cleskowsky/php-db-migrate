<?php

class Ddl_ForeignKeyTest extends PHPUnit_Framework_TestCase
{
    function testSetReferenceTableOnFK()
    {
        $t = new Ddl_Table('A');
        $t->integer('user_id');
        $columns = $t->getColumns();
        
        $fk = new Ddl_ForeignKey($columns[0]);
        $fk->references($table = 'users', $field = 'id');
        $this->assertEquals('users', $fk->getReferenceTable());
        $this->assertEquals('id', $fk->getReferenceColumn());
        $this->assertEquals('user_id', $fk->getLocalColumn());
    }
}

?>