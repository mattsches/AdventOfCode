<?php

namespace AoC2018;

/**
 * Interface DayInterface
 * @package AoC2018
 */
interface DayInterface
{
    /**
     * @param string $input
     */
    public function solveFirst(string $input);

    /**
     * @param string $input
     */
    public function solveSecond(string $input);
}
