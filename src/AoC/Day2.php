<?php
namespace AoC;

/**
 * Class Day2
 * @package AoC
 */
class Day2 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(\string $input)
    {
        $order = 0;
        foreach (explode("\n", $input) as $dimensions) {
            if (empty($dimensions)) {
                continue;
            }
            $order += $this->getTotalSquareFeet($dimensions);
        }

        return $order;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(\string $input)
    {
        $length = 0;
        foreach (explode("\n", $input) as $dimensions) {
            if (empty($dimensions)) {
                continue;
            }
            $length += $this->getRibbonLength($dimensions);
        }

        return $length;
    }

    /**
     * @param string $dimensions
     * @return int
     */
    public function getTotalSquareFeet(\string $dimensions): \int
    {
        $sides = explode('x', $dimensions);
        $area = $this->getBoxSurfaceArea($sides);
        $slack = $this->getSlack($sides);

        return $area + $slack;
    }

    /**
     * @param string $dimensions
     * @return int
     */
    public function getRibbonLength(\string $dimensions): \int
    {
        $sides = explode('x', $dimensions);
        sort($sides, SORT_ASC);
        $ribbon = 2 * ($sides[0] + $sides[1]);
        $volume = array_product($sides);
        $feet = $ribbon + $volume;

        return $feet;
    }

    /**
     * @param array $sides
     * @return int
     */
    private function getBoxSurfaceArea(array $sides): \int
    {
        return 2 * $sides[0] * $sides[1] + 2 * $sides[1] * $sides[2] + 2 * $sides[2] * $sides[0];
    }

    /**
     * @param array $sides
     * @return int
     */
    private function getSlack(array $sides): \int
    {
        sort($sides, SORT_ASC);

        return array_product(array_slice($sides, 0, 2));
    }
}
