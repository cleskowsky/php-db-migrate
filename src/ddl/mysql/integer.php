<?php

/**
 * Integer columns
 */
class Ddl_Mysql_Integer extends Ddl_Mysql_Base
{
    private $auto_incrementing = false;
    
    protected $mysql_types = array(
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