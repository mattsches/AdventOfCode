<?php

namespace AoC2017;

/**
 * Class Day2
 * @package AoC2017
 */
class Day2 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        return array_reduce(explode("\n", $input), function ($output, $line) {
            $numbers = preg_split('/\s+/', $line);
            $output += max($numbers) - min($numbers);
            return $output;
        });
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $output = 0;
        $input = trim($input);
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $numbers = $numbers2 = preg_split('/\s+/', $line);
            foreach ($numbers as $number) {
                foreach ($numbers2 as $number2) {
                    if ($number !== $number2 && $number % $number2 === 0) {
                        $output += $number / $number2;
                        break 2;
                    }
                }
            }
        }
        return $output;
    }
}
