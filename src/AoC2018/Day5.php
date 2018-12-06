<?php

namespace AoC2018;

/**
 * Class Day5
 * @package AoC2018
 */
class Day5 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $units = str_split(trim($input));
        while (true) {
            $b = '';
            $reset = false;
            foreach ($units as $key => $unit) {
                if (abs(ord($unit) - ord($b)) === 32) {
                    unset($units[$key], $units[$key - 1]);
                    $units = array_values($units);
                    $reset = true;
                    break;
                }
                $b = $unit;
            }
            if (!$reset) {
                break;
            }
        }
        return \count($units);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $result = [];
        foreach (range('a', 'z') as $char) {
            $in = str_ireplace($char, '', $input);
            $result[$char] = $this->solveFirst($in);
        }
        return min($result);
    }
}
