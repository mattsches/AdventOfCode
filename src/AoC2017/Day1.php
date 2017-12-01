<?php

namespace AoC2017;

/**
 * Class Day1
 * @package AoC2017
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
        $strLen = \strlen($input);
        $inputAsArray = str_split($input);
        foreach ($inputAsArray as $key => $value) {
            if ($key === $strLen - 1) {
                if ($value === $inputAsArray[0]) {
                    $output += $value;
                }
            } elseif ($value === $inputAsArray[$key + 1]) {
                $output += $value;
            }
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
        $strLen = \strlen($input);
        $offset = $strLen / 2;
        $inputAsArray = str_split($input);
        foreach ($inputAsArray as $key => $value) {
            $targetIndex = $key + $offset;
            if ($targetIndex > $strLen - 1) {
                $targetIndex = $key - $offset;
            }
            if ($value === $inputAsArray[$targetIndex]) {
                $output += $value;
            }
        }
        return $output;
    }
}
