<?php

namespace AoC2017;

/**
 * Class Day4
 * @package AoC2017
 */
class Day4 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $validCount = 0;
        $phrases = explode("\n", $input);
        foreach ($phrases as $phrase) {
            $words = explode(' ', $phrase);
            $unique = array_unique($words);
            if (\count($words) === \count($unique)) {
                $validCount++;
            }
        }
        return $validCount;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $validCount = 0;
        $phrases = explode("\n", $input);
        foreach ($phrases as $phrase) {
            $words = $unique = explode(' ', $phrase);
            array_walk($unique, function (&$word) {
                $letters = str_split($word);
                sort($letters);
                $word = implode($letters);
            });
            $unique = array_unique($unique);
            if (\count($words) === \count($unique)) {
                $validCount++;
            }
        }
        return $validCount;
    }
}
