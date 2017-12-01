<?php
namespace AoC2015;

/**
 * Interface Day
 * @package AoC2015
 */
interface DayInterface
{
    /**
     * @param string $input
     * @return mixed
     */
    public function solveFirst(string $input);

    /**
     * @param string $input
     * @return mixed
     */
    public function solveSecond(string $input);
}
