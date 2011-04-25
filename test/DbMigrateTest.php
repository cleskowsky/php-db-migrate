<?php

include 'DbMigrate.php';

class DbMigrateTest extends PHPUnit_Framework_TestCase
{
    function testCreateTable()
    {
        $db = new DbMigrate();
        $db->createTable('orders');
        $this->assertTrue(1 == count($db->_getNewTables()), 'Expect \'orders\' table should be created');
    }
}

?>