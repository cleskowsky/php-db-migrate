<?php

include 'MigrationRunner.php';

class MigrationRunnerTest extends PHPUnit_Framework_TestCase
{
    function testCreateTable()
    {
        $db = new MigrationRunner();
        $db->createTable('orders');
        $this->assertTrue(1 == count($db->_getNewTables()), 'Expect \'orders\' table should be created');
    }
}

?>