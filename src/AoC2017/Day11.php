<?php

namespace AoC2017;

/**
 * Class Hex
 * @package AoC2017
 * @see https://www.redblobgames.com/grids/hexagons/
 */
class Hex
{
    /**
     * @var int
     */
    public $x;

    /**
     * @var int
     */
    public $y;

    /**
     * @var int
     */
    public $z;

    /**
     * Hex constructor.
     * @param int $x
     * @param int $y
     * @param int $z
     */
    public function __construct(int $x, int $y, int $z)
    {
        \assert($x + $y + $z === 0);
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @param string $cardinalDirection
     * @return Hex
     */
    public static function getDirection(string $cardinalDirection): Hex
    {
        $hexDirections = [
            'n' => new Hex(0, 1, -1),
            'ne' => new Hex(1, 0, -1),
            'se' => new Hex(1, -1, 0),
            's' => new Hex(0, -1, 1),
            'sw' => new Hex(-1, 0, 1),
            'nw' => new Hex(-1, 1, 0),
        ];
        \assert(array_key_exists($cardinalDirection, $hexDirections));
        return $hexDirections[$cardinalDirection];
    }

    /**
     * @param Hex $hex
     * @return Hex
     */
    public function add(Hex $hex): Hex
    {
        return new Hex($this->x + $hex->x, $this->y + $hex->y, $this->z + $hex->z);
    }

    /**
     * @param Hex $hex
     * @return Hex
     */
    public function subtract(Hex $hex): Hex
    {
        return new Hex($this->x - $hex->x, $this->y - $hex->y, $this->z - $hex->z);
    }

    /**
     * @param Hex $hex
     * @return int
     */
    public function length(Hex $hex): int
    {
        return (abs($hex->x) + abs($hex->y) + abs($hex->z)) / 2;
    }

    /**
     * @param Hex $hex
     * @return int
     */
    public function distance(Hex $hex): int
    {
        return $this->length($this->subtract($hex));
    }
}

/**
 * Class Day11
 * @package AoC2017
 */
class Day11 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $start = $current = new Hex(0, 0, 0);
        foreach (explode(',', $input) as $direction) {
            $current = $current->add(Hex::getDirection($direction));
        }
        return $start->distance($current);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $start = $current = new Hex(0, 0, 0);
        $distance = 0;
        foreach (explode(',', $input) as $direction) {
            $current = $current->add(Hex::getDirection($direction));
            $distance = max($distance, $start->distance($current));
        }
        return $distance;
    }
}
