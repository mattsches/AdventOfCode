<?php

namespace AoC2017;

/**
 * Class Day8
 * @package AoC2017
 */
class Day8 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        return $this->calculate($input)[0];
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        return $this->calculate($input)[1];
    }

    /**
     * @param string $input
     * @return array
     */
    private function calculate(string $input): array
    {
        $instructions = explode("\n", trim($input));
        $values = [];
        $registers = [];
        $pattern = "/([a-z]+)\s(inc|dec)\s([0-9-]+)\sif\s([a-z]+)\s([<>=!]{1,2})\s([0-9-]+)/i";
        foreach ($instructions as $instruction) {
            if (preg_match($pattern, $instruction, $m) === 0) {
                continue;
            }
            if (!array_key_exists($m[1], $registers)) {
                $registers[$m[1]] = 0;
            }
            if (!array_key_exists($m[4], $registers)) {
                $registers[$m[4]] = 0;
            }
            $constraintResult = false;
            eval(sprintf('$constraintResult = $registers["%s"] %s %d;', $m[4], $m[5], $m[6]));
            if ($constraintResult === false) {
                continue;
            }
            eval(sprintf('$registers["%s"] %s= %d;', $m[1], $m[2] === 'inc' ? '+' : '-', $m[3]));
            $values[] = $registers[$m[1]];
        }
        return [max($registers), max($values)];
    }
}
