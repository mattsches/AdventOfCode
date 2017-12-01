<?php
declare(strict_types=1);
namespace AoC2015;

/**
 * Class Day1
 * @package AoC2015
 */
class Day1 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input)
    {
        return $this->getFloor($input);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input)
    {
        return $this->getBasementPosition($input);
    }

    /**
     * @param string $input
     *
     * @return int
     */
    public function getFloor(string $input): int
    {
        $up = substr_count($input, '(');
        $down = substr_count($input, ')');
        $floor = $up - $down;

        return $floor;
    }

    /**
     * @param string $input
     *
     * @return int
     */
    public function getBasementPosition(string $input): int
    {
        $floor = 0;
        $position = -1;
        foreach (str_split($input) as $position => $char) {
            $floor += $char == '(' ? 1 : -1;
            if ($floor === -1) {
                break;
            }
        }

        return $position + 1;
    }
}
