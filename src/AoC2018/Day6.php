<?php

namespace AoC2018;

/**
 * Class Day6
 * @package AoC2018
 */
class Day6 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $coordinates = array_map(function ($v) {
            return explode(', ', $v);
        }, explode(PHP_EOL, $input));
        $maxX = $maxY = 0;
        foreach ($coordinates as $coordinate) {
            if ($coordinate[0] > $maxX) {
                $maxX = $coordinate[0];
            }
            if ($coordinate[1] > $maxY) {
                $maxY = $coordinate[1];
            }
        }
        $cnt = $this->getCnt($maxX, $maxY, $coordinates, 10);
        $cnt2 = $this->getCnt($maxX, $maxY, $coordinates, 20);
        return max(array_intersect($cnt, $cnt2));
    }

    /**
     * @param string $input
     * @param int $limit
     * @return int
     */
    public function solveSecond(string $input, int $limit = 10000): int
    {
        $input = trim($input);
        $coordinates = array_map(function ($v) {
            return explode(', ', $v);
        }, explode(PHP_EOL, $input));
        $maxX = $maxY = 0;
        foreach ($coordinates as $coordinate) {
            if ($coordinate[0] > $maxX) {
                $maxX = $coordinate[0];
            }
            if ($coordinate[1] > $maxY) {
                $maxY = $coordinate[1];
            }
        }
        $d = [];
        foreach (range(0, $maxX) as $x) {
            foreach (range(0, $maxY) as $y) {
                $d[$x][$y] = 0;
                foreach ($coordinates as $key => $coordinate) {
                    $d[$x][$y] += $this->getDistance($coordinate, [$x, $y]);
                }
                if ($d[$x][$y] >= $limit) {
                    unset($d[$x][$y]);
                }
            }
            if (count($d[$x]) === 0) {
                unset($d[$x]);
            }
        }
        $output = array_reduce($d, function ($carry, $x) {
            return $carry + count($x);
        });
        return $output;
    }

    /**
     * @param array $a
     * @param array $b
     * @return int
     */
    private function getDistance(array $a, array $b): int
    {
        return abs($a[0] - $b[0]) + abs($a[1] - $b[1]);
    }

    /**
     * @param int $maxX
     * @param int $maxY
     * @param array $coordinates
     * @param int $offset
     * @return array
     */
    private function getCnt(int $maxX, int $maxY, array $coordinates, int $offset): array
    {
        $cnt = [];
        for ($x = $offset * -1; $x < $maxX + $offset; $x++) {
            for ($y = $offset * -1; $y < $maxY + $offset; $y++) {
                $location = null;
                $distance = 0;
                foreach ($coordinates as $key => $coordinate) {
                    $d = $this->getDistance($coordinate, [$x, $y]);
                    if ($d === 0) {
                        $location = $key;
                        break;
                    }

                    if ($distance === 0 || $d < $distance) {
                        $location = $key;
                        $distance = $d;
                    } elseif ($d === $distance) {
                        $location = '.';
                    }
                }
                $cnt[$location] = isset($cnt[$location]) ? $cnt[$location] + 1 : 1;
            }
        }
        return $cnt;
    }
}
