<?php

/**
 * Autoloader...
 */
function migration_assistant_autoloader($klass)
{
    if (empty($klass)) {
        return;
    }
    require_once join('/', explode('_', $klass)) . '.php';
}
spl_autoload_register('migration_assistant_autoloader');

?>