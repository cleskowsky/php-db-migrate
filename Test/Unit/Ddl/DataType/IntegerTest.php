<?php

class Ddl_DataType_IntegerTest extends PHPUnit_Framework_TestCase
{
    function test_set_integer_limit_to_large()
    {
        $type = new Ddl_DataType_Integer('large');
        $this->assertEquals('large', $type->get_limit());
        $this->assertRegexp('/bigint/', (string)$type);
    }
}

?>