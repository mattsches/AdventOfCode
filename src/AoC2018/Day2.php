<?php

namespace AoC2018;

/**
 * Class Day2
 * @package AoC2018
 */
class Day2 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $inputs = explode("\n", trim($input));
        $occurrences = [
            2 => 0,
            3 => 0,
        ];
        foreach ($inputs as $item) {
            $freq = count_chars($item, 1);
            if (\in_array(2, $freq, true)) {
                ++$occurrences[2];
            }
            if (\in_array(3, $freq, true)) {
                ++$occurrences[3];
            }
        }
        return $occurrences[2] * $occurrences[3];
    }

    /**
     * @param string $input
     * @return string
     */
    public function solveSecond(string $input): string
    {
        $boxIds = explode("\n", trim($input));
        $correctBoxIds = array_filter($boxIds, function ($id) use ($boxIds) {
            foreach ($boxIds as $boxId) {
                if (levenshtein($id, $boxId) === 1) {
                    return true;
                }
            }
            return false;
        });
        $firstBoxId = str_split(array_shift($correctBoxIds));
        $secondBoxId = str_split(array_shift($correctBoxIds));
        return implode('', array_intersect($firstBoxId, $secondBoxId));
    }
}
