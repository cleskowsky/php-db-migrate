<?php

/**
 * Text columns
 */
class Ddl_Mysql_Text extends Ddl_Mysql_Base
{
    protected $mysqlTypes = array(
        'small'  => 'tinytext',
        'medium' => 'text',
        'large'  => 'longtext'
    );
}

?>