<?php

namespace AoC2018;

/**
 * Class Day3
 * @package AoC2018
 */
class Day3 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $claims = $this->parseClaims($input);
        $maxX = $maxY = 0;
        foreach ($claims as $claim) {
            $maxX = max([$maxX, $claim['x2']]);
            $maxY = max([$maxY, $claim['y2']]);
        }
        $fabric = array_fill(0, $maxX + 1, array_fill(0, $maxY + 1, 0));
        foreach ($claims as $claim) {
            foreach (range($claim['x1'], $claim['x2'] - 1) as $x) {
                foreach (range($claim['y1'], $claim['y2'] - 1) as $y) {
                    $fabric[$x][$y] += 1;
                }
            }
        }
        return array_reduce($fabric, function ($carry, $item) {
            $carry += \count(array_filter($item, function ($i) {
                return $i >= 2;
            }));
            return $carry;
        });
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $claims = $this->parseClaims($input);
        $maxX = $maxY = 0;
        foreach ($claims as $claim) {
            $maxX = max([$maxX, $claim['x2']]);
            $maxY = max([$maxY, $claim['y2']]);
        }
        $fabric = array_fill(0, $maxX + 1, array_fill(0, $maxY + 1, 0));
        foreach ($claims as $id => $claim) {
            foreach (range($claim['x1'], $claim['x2'] - 1) as $x) {
                foreach (range($claim['y1'], $claim['y2'] - 1) as $y) {
                    if ($fabric[$x][$y] === 0) {
                        $fabric[$x][$y] = $id;
                    } else {
                        $fabric[$x][$y] = -1;
                    }
                }
            }
        }
        // find rectangles
        $lengths = [];
        foreach ($fabric as $row => $line) {
            foreach ($line as $col => $claimId) {
                if ($claimId <= 0) {
                    continue;
                }
                if (!array_key_exists($claimId, $lengths)) {
                    $lengths[$claimId] = [];
                }
                if (!array_key_exists($row, $lengths[$claimId])) {
                    $lengths[$claimId][$row] = 0;
                }
                $lengths[$claimId][$row] += 1;
            }
        }
        // find all claims with the same length (= column count)
        $lengths = array_filter($lengths, function ($length) {
            return (\count(array_unique($length)) === 1);
        });
        // find the claim that has the same x,y length as in the fabric
        $lengths = array_filter($lengths, function ($length, $claimId) use ($claims) {
            $xLength = $claims[$claimId]['x2'] - $claims[$claimId]['x1'];
            $yLength = $claims[$claimId]['y2'] - $claims[$claimId]['y1'];
            return ($xLength === \count($length) && $yLength === array_pop($length));
        }, ARRAY_FILTER_USE_BOTH);
        return key($lengths);
    }

    /**
     * @param string $input
     * @return array
     */
    private function parseClaims(string $input): array
    {
        $claims = [];
        foreach (explode("\n", $input) as $line) {
            preg_match('/#(\d+) @ (\d+),(\d+): (\d+)x(\d+)/', $line, $matches);
            $claims[$matches[1]] = [
                'x1' => (int)$matches[2],
                'y1' => (int)$matches[3],
                'x2' => $matches[2] + $matches[4],
                'y2' => $matches[3] + $matches[5],
            ];
        }
        return $claims;
    }
}
