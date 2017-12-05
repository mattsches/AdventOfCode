<?php

namespace AoC2017;

/**
 * Class Day5
 * @package AoC2017
 */
class Day5 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $instructions = explode("\n", $input);
        $steps = 0;
        $offset = 0;
        while (array_key_exists($offset, $instructions)) {
            ++$steps;
            $jump = $instructions[$offset];
            ++$instructions[$offset];
            $offset += $jump;
        }
        return $steps;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $instructions = explode("\n", $input);
        $steps = 0;
        $offset = 0;
        while (array_key_exists($offset, $instructions)) {
            ++$steps;
            $jump = $instructions[$offset];
            $instructions[$offset] += $jump >= 3 ? -1 : 1;
            $offset += $jump;
        }
        return $steps;
    }
}
