<?php

namespace AoC2017;

/**
 * Class Day13
 * @package AoC2017
 */
class Day13 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $layers = $this->getLayers($input);
        $layers = array_filter($layers, function ($v, $k) {
            return $k % (2 * ($v - 1)) === 0;
        }, ARRAY_FILTER_USE_BOTH);
        $layers = array_map(function ($v, $k) {
            return $v * $k;
        }, $layers, array_keys($layers));
        return array_sum($layers);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $layers = $this->getLayers($input);
        $layersCount = max(array_keys($layers));
        $start = 0;
        while (true) {
            foreach ($layers as $k => $v) {
                if (($start + $k) % (2 * ($v - 1)) === 0) {
                    break;
                }
                if ($k === $layersCount) {
                    break 2;
                }
                continue;
            }
            ++$start;
        }
        return $start;
    }

    /**
     * @param string $input
     * @return array
     */
    private function getLayers(string $input): array
    {
        $input = trim($input);
        $layers = [];
        foreach (explode("\n", $input) as $line) {
            $p = explode(': ', $line);
            $layers[$p[0]] = (int)$p[1];
        }
        return $layers;
    }
}
