<?php

define('EXPECTED_SQL_MIGRATION2', "CREATE TABLE(`A`) (\n"            .
                                  "  `col1` INT(11) NOT NULL,\n"     .
                                  "  `col2` TEXT NOT NULL,\n"        .
                                  "  PRIMARY KEY (`col1`, `col2`)\n" .
                                  ") ENGINE=INNODB DEFAULT CHARACTER SET=UTF8;");

class Migration2 extends Migration
{
    function up()
    {
        $t = $this->create_table('A', array(
            'primary_key' => array('col1', 'col2')
        ));
        $t->integer('col1');
        $t->text('col2');
    }
    
    function down() {}
}

?>