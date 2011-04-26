<?php

/**
 * Autoloader...
 */
function dbMigrateAutoloader($klass)
{
    if (empty($klass)) {
        return;
    }
    require_once join('/', explode('_', $klass)) . '.php';
}
spl_autoload_register('dbMigrateAutoloader');

?>