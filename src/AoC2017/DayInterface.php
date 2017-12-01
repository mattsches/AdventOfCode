<?php

namespace AoC2017;

/**
 * Interface DayInterface
 * @package AoC2017
 */
interface DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int;

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int;
}
