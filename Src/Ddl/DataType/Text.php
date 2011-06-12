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
class Ddl_DataType_Text extends Ddl_DataType_Base
{
    protected $default_limits = array(
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
        if (is_numeric($this->limit)) {
            if (1 == $this->limit) {
                $str = "char(1)";
            } else {
                $str = "varchar({$this->limit})";
            }
            return $str;
        }
        return parent::__toString();
    }
}

?>