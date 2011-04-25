<?php

require '../src/DbMigrate.php';

class DbMigrateTest extends PHPUnit_Framework_TestCase
{
    function testCreateTable()
    {
        $db = new DbMigrate();
        $db->createTable('orders');
        $this->assertTrue(1 == count($db->_getNewTables()), 'Expected a table description waiting for creation');
    }
}

?>