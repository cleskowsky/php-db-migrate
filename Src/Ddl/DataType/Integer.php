<?php

/**
 * Integer columns
 */
class Ddl_DataType_Integer extends Ddl_DataType_Base
{
    private $auto_incrementing = false;
    
    protected $default_limits = array(
        'small'  => 'tinyint',
        'medium' => 'int',
        'large'  => 'bigint'
    );
    
    function is_auto_incrementing()
    {
        return $this->auto_incrementing;
    }
    
    function handle_extras($extras)
    {
        if (isset($extras['auto_increment'])) {
            $this->auto_incrementing = true;
        }
    }
}

?>