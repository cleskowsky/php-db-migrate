<?php

function migration_assistant_autoloader($class)
{
    if (empty($class)) {
        return;
    }
    require_once str_replace('_', '/', $class) . '.php';
}
spl_autoload_register('migration_assistant_autoloader');

?>