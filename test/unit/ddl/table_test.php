<?php

class Ddl_TableTest extends PHPUnit_Framework_TestCase
{
    function testSetForeignKey()
    {
        $t = new Ddl_Table('A');
        $t->integer('col1_id');
        
        $t->key('col1_id')->references('B', 'col1');
        $this->assertTrue(1 == count($t->_getKeys()), 'Expect 1 foreign key should be created');
    }
}

?>