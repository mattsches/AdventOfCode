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
        $claims = $this->parseClaims(trim($input));
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
        $claims = $this->parseClaims(trim($input));
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
        foreach (explode(PHP_EOL, $input) as $line) {
            preg_match_all('/\d+/', $line, $m);
            $claims[$m[0][0]] = [
                'x1' => (int)$m[0][1],
                'y1' => (int)$m[0][2],
                'x2' => $m[0][1] + $m[0][3],
                'y2' => $m[0][2] + $m[0][4],
            ];
        }
        return $claims;
    }
}
