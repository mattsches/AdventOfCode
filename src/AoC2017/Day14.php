<?php

namespace AoC2017;

/**
 * Class Day14
 * @package AoC2017
 */
class Day14 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $hashes = [];
        $day10 = new Day10();
        foreach (range(0, 127) as $iteration) {
            $hashes[] = $day10->solveSecond($input . '-' . $iteration);
        }
        $usedCount = array_map(function ($v) {
            $result = '';
            foreach (str_split($v) as $c) {
                $result .= str_pad(base_convert($c, 16, 2), 4, '0', STR_PAD_LEFT);
            }
            return substr_count($result, '1');
        }, $hashes);
        return array_sum($usedCount);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $hashes = [];
        $day10 = new Day10();
        foreach (range(0, 127) as $iteration) {
            $hashes[] = $day10->solveSecond($input . '-' . $iteration);
        }
        $matrix = array_map(function ($v) {
            $result = '';
            foreach (str_split($v) as $c) {
                $result .= str_pad(base_convert($c, 16, 2), 4, '0', STR_PAD_LEFT);
            }
            return array_map(function ($v) {
                return $v === '1' ? '#' : ' ';
            }, str_split($result));
        }, $hashes);
        $regionId = 0;
        foreach (range(0, 127) as $i) {
            foreach (range(0, 127) as $j) {
                if ($matrix[$i][$j] === '#') {
                    $matrix = $this->findAdjacent($matrix, $i, $j, $regionId);
                    $regionId++;
                }
            }
        }
        $regionArray = [];
        /** @var array $row */
        foreach ($matrix as $row) {
            foreach ($row as $cell) {
                if (!\in_array($cell, $regionArray, true)) {
                    $regionArray[] = $cell;
                }
            }
        }
        return \count($regionArray) - 1;
    }

    /**
     * @param array $matrix
     * @param int $i
     * @param int $j
     * @param int $regionId
     * @return array
     */
    private function findAdjacent(array $matrix, int $i, int $j, int $regionId): array
    {
        $matrix[$i][$j] = $regionId;
        if ($i + 1 < 128) {
            if ($matrix[$i + 1][$j] === '#') {
                $matrix = $this->findAdjacent($matrix, $i + 1, $j, $regionId);
            }
        }
        if ($j + 1 < 128) {
            if ($matrix[$i][$j + 1] === '#') {
                $matrix = $this->findAdjacent($matrix, $i, $j + 1, $regionId);
            }
        }
        if ($i - 1 >= 0) {
            if ($matrix[$i - 1][$j] === '#') {
                $matrix = $this->findAdjacent($matrix, $i - 1, $j, $regionId);
            }
        }
        if ($j - 1 >= 0) {
            if ($matrix[$i][$j - 1] === '#') {
                $matrix = $this->findAdjacent($matrix, $i, $j - 1, $regionId);
            }
        }
        return $matrix;
    }
}
