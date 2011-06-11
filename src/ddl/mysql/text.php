<?php

/**
 * Text and Varchar columns
 *
 * Since varchar typed columns are more common in my experience
 * they're the default. You get varchars by passing in a numeric
 * limit. (Default is 255.)
 *
 * $t->text('email') => varchar(255)
 *
 * You get text columns by using limit:
 *
 * $t->text('body', array('limit' => 'medium')); # or small, large
 */
class Ddl_Mysql_Text extends Ddl_Mysql_Base
{
    protected $mysql_types = array(
        'small'  => 'tinytext',
        'medium' => 'text',
        'large'  => 'longtext'
    );
    
    function __construct($limit = 255)
    {
        $this->limit = $limit;
    }

    function __toString()
    {
        // use varchar for integral limits
        if (is_numeric($this->limit)) {
            return "varchar({$this->limit})";
        }
        return parent::__toString();
    }
}

?>