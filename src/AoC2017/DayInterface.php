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
     */
    public function solveFirst(string $input);

    /**
     * @param string $input
     */
    public function solveSecond(string $input);
}
