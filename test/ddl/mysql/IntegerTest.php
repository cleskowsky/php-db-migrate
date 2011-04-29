<?php

class Ddl_Mysql_IntegerTest extends PHPUnit_Framework_TestCase
{
    function testSetIntegerLimitToLarge()
    {
        $type = new Ddl_Mysql_Integer('large');
        $this->assertEquals('large', $type->getLimit());
        $this->assertRegexp('/bigint\(20\)/', (string)$type);
    }
}

?>