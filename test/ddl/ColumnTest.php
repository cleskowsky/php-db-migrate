<?php

class Ddl_ColumnTest extends PHPUnit_Framework_TestCase
{
    function testSettingNotNullToTrueOnColumn()
    {
        $col = new Ddl_Column('name', 'type', $notNull = true);
        $this->assertTrue($col->_getNotNull(), 'Expect notNull is true on column');
        
        // non-bool
        try {
            $col = new Ddl_Column('name', 'type', $notNull = 'a');            
        } catch (Exception $ex) {
            return;
        }
        $this->fail('Expect exception is thrown for bad $notNull value');
    }
    
    function testSettingDefaultTo0OnColumn()
    {
        $col = new Ddl_Column('name', 'type', $notNull = true, $defaultValue = 0);
        $this->assertEquals(0, $col->_getDefaultValue());
    }
}

?>