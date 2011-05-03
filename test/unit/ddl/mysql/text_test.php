<?php

class Ddl_Mysql_TextTest extends PHPUnit_Framework_TestCase
{
    function test_default_text_length_is_medium()
    {
        $type = new Ddl_Mysql_Text();
        $this->assertEquals('medium', $type->get_limit());
    }
    
    function test_set_text_length_to_other()
    {
        $type = new Ddl_Mysql_Text('large');
        $this->assertEquals('large', $type->get_limit());
        $this->assertRegexp('/longtext/', (string)$type);
    }
}

?>