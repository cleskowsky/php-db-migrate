<?php

class Ddl_Mysql_typeTest extends PHPUnit_Framework_TestCase
{
    function testDefaultTextLengthIsMedium()
    {
        $type = new Ddl_Mysql_Text();
        $this->assertEquals('medium', $type->getLimit());
    }
    
    function testSetTextLengthToOther()
    {
        $type = new Ddl_Mysql_Text('large');
        $this->assertEquals('large', $type->getLimit());
        $this->assertRegexp('/longtext/', (string)$type);
    }
}

?>