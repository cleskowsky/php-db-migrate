<?php

require_once 'Autoloader.php';

require_once 'Data/Migration1.php';

class Sql_Writer_DbTest extends PHPUnit_Framework_TestCase
{
    function test_create_table_with_single_id_column()
    {
        $m = new Migration1();
        $m->up();

        $tables = $m->get_new_tables();
        $stmt_generator = new Sql_Writer_Db($tables, 'mysql');
        $sql = $stmt_generator->get_sql();
        $this->assertEquals(EXPECTED_SQL_MIGRATION1, $sql);
print_r($sql);
    }
}

?>