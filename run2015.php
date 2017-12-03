<?php

use AoC2015\DayInterface;

require_once 'vendor/autoload.php';
if ($argc !== 2 || (!in_array((int)$argv[1], range(1, 24), true) && $argv[1] !== 'all')) {
    die('Please pass a day, e.g. `php run2015.php 12`' . PHP_EOL);
}
if ($argv[1] === 'all') {
    die('Not implemented yet!' . PHP_EOL);
}
$d = (int)$argv[1];
$input = file_get_contents(__DIR__ . '/src/AoC2015/inputs/Day' . $d . '.txt');
$classname = 'AoC2015\Day' . $d;
/** @var DayInterface $day */
$day = new $classname();
echo $d . '.1 => ' . $day->solveFirst($input) . PHP_EOL;
echo $d . '.2 => ' . $day->solveSecond($input) . PHP_EOL;
