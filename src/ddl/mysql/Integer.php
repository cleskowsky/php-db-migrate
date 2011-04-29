<?php

/**
 * Integer columns
 */
class Ddl_Mysql_Integer extends Ddl_Mysql_Base
{
    protected $mysqlTypes = array(
        'small'  => 'tinyint',
        'medium' => 'int(11)',
        'large'  => 'bigint(20)'
    );
}

?>