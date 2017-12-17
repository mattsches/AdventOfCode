<?php

namespace AoC2017;

/**
 * Class Day17
 * @package AoC2017
 */
class Day17 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $buffer = [0];
        $counter = 1;
        $offset = 0;
        while ($counter <= 2017) {
            $offset = (($offset + $input) % $counter) + 1;
            array_splice($buffer, $offset, 0, $counter);
            $counter++;
        }
        return $buffer[$offset + 1];
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $offset = 0;
        $result = 0;
        for ($counter = 1; $counter <= 50000000; $counter++) {
            $offset = (($offset + $input) % $counter) + 1;
            if ($offset === 1) {
                $result = $counter;
            }
            $skipSteps = floor(($counter - $offset) / $input);
            $offset += ($input + 1) * $skipSteps;
            $counter += $skipSteps;
        }
        return $result;
    }
}
