<?php
spl_autoload_register('autoload');
function autoload($className)
{
    if (strpos($className, 'AoC2015') !== 0 && strpos($className, 'AoC2017') !== 0) {
        return;
    }
    include 'src/' . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
}
