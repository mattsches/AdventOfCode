<?php
spl_autoload_register('autoload');
function autoload($className)
{
    if (strpos($className, 'AoC') !== 0) {
        return;
    }
    include 'src/' . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
}
