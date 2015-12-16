<?php
namespace AoC;

/**
 * Class Day3
 * @package AoC
 */
class Day3 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(\string $input)
    {
        return $this->getUniqueHouses($input);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(\string $input)
    {
        return $this->getUniqueHousesWithRobotSanta($input);
    }

    /**
     * @param string $input
     * @return int
     */
    public function getUniqueHouses(\string $input): \int
    {
        $position = [0, 0];
        $uniques = [$position];
        foreach (str_split($input) as $direction) {
            $position = $this->move($direction, $position);
            if (!in_array($position, $uniques)) {
                array_push($uniques, $position);
            }
        }

        return count($uniques);
    }

    /**
     * @param string $input
     * @return int
     */
    public function getUniqueHousesWithRobotSanta(\string $input): \int
    {
        $position = [0, 0];
        $santaPosition = $robotSantaPosition = $position;
        $uniques = [$position];
        $counter = 0;
        foreach (str_split($input) as $direction) {
            if ($counter % 2) {
                // Robot Santa
                $robotSantaPosition = $this->move($direction, $robotSantaPosition);
                if (!in_array($robotSantaPosition, $uniques)) {
                    array_push($uniques, $robotSantaPosition);
                }
            } else {
                $santaPosition = $this->move($direction, $santaPosition);
                if (!in_array($santaPosition, $uniques)) {
                    array_push($uniques, $santaPosition);
                }
            }
            $counter++;
        }

        return count($uniques);
    }

    /**
     * @param string $direction
     * @param array $position
     */
    private function move($direction, $position): array
    {
        switch ($direction) {
            case '^':
                $position[1] += 1;
                break;
            case '>':
                $position[0] += 1;
                break;
            case 'v':
                $position[1] -= 1;
                break;
            case '<':
                $position[0] -= 1;
                break;
            default:
                break;
        }

        return $position;
    }
}
