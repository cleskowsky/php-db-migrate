<?php

define('EXPECTED_SQL_MIGRATION1', "CREATE TABLE(`A`) (\n"                        .
                                  "  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,\n" .
                                  ") ENGINE=INNODB DEFAULT CHARACTER SET=UTF8;");

class Migration1 extends Migration
{
    function up()
    {
        $t = $this->create_table('A');
    }
    
    function down() {}
}

?>