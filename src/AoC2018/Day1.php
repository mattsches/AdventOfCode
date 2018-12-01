<?php

namespace AoC2018;

use ArrayIterator;
use InfiniteIterator;

/**
 * Class Day1
 * @package AoC2018
 */
class Day1 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $output = 0;
        $input = trim($input);
        foreach ($this->getFrequencyChanges($input) as $frequencyChange) {
            $output = eval('return ' . $output . $frequencyChange . ';');
        }
        return $output;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $output = 0;
        $input = trim($input);
        $frequencyChanges = $this->getFrequencyChanges($input);
        $infinite = new InfiniteIterator(new ArrayIterator($frequencyChanges));
        $frequenciesReached = [0];
        foreach ($infinite as $frequencyChange) {
            $output = eval('return ' . $output . $frequencyChange . ';');
            if (\in_array($output, $frequenciesReached, true)) {
                break;
            }
            $frequenciesReached[] = $output;
        }
        return $output;
    }

    /**
     * @param string $input
     * @return array
     */
    private function getFrequencyChanges(string $input): array
    {
        if (strpos($input, ',') !== false) {
            $frequencyChanges = explode(', ', $input);
        } else {
            $frequencyChanges = explode("\n", $input);
        }
        return $frequencyChanges;
    }
}
