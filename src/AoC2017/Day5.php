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
        array_walk($instructions, function (&$instruction) {
            $instruction = (int)$instruction;
        });
        $steps = 0;
        $offset = 0;
        while (array_key_exists($offset, $instructions)) {
            ++$steps;
            $jump = $instructions[$offset];
            if ($jump === 0) {
                $instructions[$offset] += 2;
                ++$steps;
                ++$offset;
                continue;
            }
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
        array_walk($instructions, function (&$instruction) {
            $instruction = (int)$instruction;
        });
        $steps = 0;
        $offset = 0;
        while (array_key_exists($offset, $instructions)) {
            ++$steps;
            $jump = $instructions[$offset];
            if ($jump === 0) {
                $instructions[$offset] += 2;
                ++$steps;
                ++$offset;
                continue;
            }
            if ($jump >= 3) {
                --$instructions[$offset];
                $offset += $jump;
                continue;
            }
            ++$instructions[$offset];
            $offset += $jump;
        }
        return $steps;
    }
}
