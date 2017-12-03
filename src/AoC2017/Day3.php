<?php

namespace AoC2017;

/**
 * Class Day3
 * @package AoC2017
 */
class Day3 implements DayInterface
{
    /**
     * @var
     */
    private $pastMove;

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $ringLength = 1;
        $ringLengthAddition = 8;
        // $ringDistance = distance from ring to central coordinates [0,0]
        for ($ringDistance = 0; $ringLength < $input; $ringDistance++) {
            $ringLength += $ringLengthAddition;
            $ringLengthAddition += 8;
        }
        $ringCorners = [
            $ringLength,
            $ringLength - $ringDistance * 2,
            $ringLength - ($ringDistance * 4),
            $ringLength - ($ringDistance * 6),
        ];
        return $ringDistance * 2 - min(
                abs($input - $ringCorners[0]),
                abs($input - $ringCorners[1]),
                abs($input - $ringCorners[2]),
                abs($input - $ringCorners[3])
            );
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $dirs = [
            0 => [1, 0],
            1 => [0, 1],
            2 => [-1, 0],
            3 => [0, -1],
        ];
        $directions = new \InfiniteIterator(new \ArrayIterator($dirs));
        $directions->rewind();
        $spiral = [
            1 => [0, 0]
        ];
        $fieldValues = [
            1 => 1
        ];
        for ($i = 2; $i <= $input + 10; $i++) {
            $currentMove = $directions->current();
            $spiral[$i] = $this->getDestination($spiral, $spiral[$i - 1], $currentMove);
            $fieldValues[$i] = $this->calcFieldValue($i, $spiral, $fieldValues);
            if ($fieldValues[$i] > $input) {
                return $fieldValues[$i];
            }
            if ($currentMove === $this->pastMove) {
                $directions->next();
            }
        }
        return $fieldValues[$input];
    }

    /**
     * @param $spiral
     * @param $start
     * @param $move
     * @return array
     */
    private function getDestination($spiral, $start, $move): array
    {
        $destination = array_map(function (...$arrays) {
            return array_sum($arrays);
        }, $start, $move);
        if (\in_array($destination, $spiral, true)) {
            $destination = $this->getDestination($spiral, $start, $this->pastMove);
        } else {
            $this->pastMove = $move;
        }
        return $destination;
    }

    /**
     * @param $fieldIndex
     * @param array $spiral
     * @param array $fieldValues
     * @return int
     */
    private function calcFieldValue($fieldIndex, array $spiral, array $fieldValues): int
    {
        $fieldValue = 0;
        $coordinates = $spiral[$fieldIndex];
        foreach ($spiral as $idx => $field) {
            if ($idx === $fieldIndex) {
                continue;
            }
            if (abs($coordinates[0] - $field[0]) <= 1 && abs($coordinates[1] - $field[1]) <= 1) {
                $fieldValue += $fieldValues[$idx];
            }
        }
        return $fieldValue;
    }
}
