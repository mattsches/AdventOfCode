<?php
declare(strict_types=1);
namespace AoC;

/**
 * Class Day6
 * @package AoC
 */
class Day6 implements DayInterface
{
    const ON = 'on';
    const OFF = 'off';
    const CMD_ON = 'turn on';
    const CMD_OFF = 'turn off';
    const CMD_TOGGLE = 'toggle';

    /**
     * @param mixed $input
     * @return int
     */
    public function solveFirst(\string $input): \int
    {
        $counter = 0;
        $grid = $this->initGrid();
        foreach (explode("\n", $input) as $line) {
            preg_match('/(' . self::CMD_ON . '|' . self::CMD_OFF . '|' . self::CMD_TOGGLE . ').([0-9,]{3,7})( through )([0-9,]{3,7})/i', $line, $matches);
            $start = explode(',', $matches[2]);
            $end = explode(',', $matches[4]);
            for ($i = $start[0]; $i <= $end[0]; $i++) {
                for ($j = $start[1]; $j <= $end[1]; $j++) {
                    $grid[$i][$j] = $this->setLight($matches[1], $grid[$i][$j]);
                }
            }
        }
        foreach ($grid as $k => $v) {
            $counter += count(
                array_filter(
                    $v,
                    function ($var) {
                        return ($var === self::ON);
                    }
                )
            );
        }

        return $counter;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(\string $input): \int
    {
        $counter = 0;

        return $counter;
    }

    /**
     * @return array
     */
    private function initGrid(): array
    {
        $grid = [];
        foreach (range(0, 999) as $a) {
            foreach (range(0, 999) as $b) {
                $grid [$a][$b] = self::OFF;
            }
        }

        return $grid;
    }

    /**
     * @param string $command
     * @param $value
     * @return string
     */
    private function setLight(\string $command, \string $value): \string
    {
        switch ($command) {
            case self::CMD_ON:
                return self::ON;
            case self::CMD_OFF:
                return self::OFF;
            case self::CMD_TOGGLE:
                return $value === self::OFF ? self::ON : self::OFF;
        }
    }
}
