<?php

class Ddl_ColumnTest extends PHPUnit_Framework_TestCase
{
    function test_setting_not_null_to_true_on_column()
    {
        $col = new Ddl_Column('name', 'type', $allow_null = true);
        $this->assertTrue($col->get_allow_null(), 'Expect $allow_null is true on column');
        
        // non-bool
        try {
            $col = new Ddl_Column('name', 'type', $allow_null = 'a');
        } catch (Exception $ex) {
            return;
        }
        $this->fail('Expect exception is thrown for bad $allow_null value');
    }
    
    function test_setting_default_to_0_on_column()
    {
        $col = new Ddl_Column('name', 'type', $allow_null = true, $default_value = 0);
        $this->assertEquals(0, $col->get_default_value());
    }
}

?>