<?php

namespace AoC2017;

/**
 * Class Day15
 * @package AoC2017
 */
class Day15 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        [$val1, $val2] = explode("\n", preg_replace('/[^\d\n]*/', '', $input));
        $generator1 = $this->getGenerator(16807);
        $generator2 = $this->getGenerator(48271);
        $matches = 0;
        for ($i = 0; $i < 40000000; $i++) {
            $val1 = $generator1($val1)->current();
            $val2 = $generator2($val2)->current();
            if (($val1 & 65535) === ($val2 & 65535)) {
                $matches++;
            }
        }
        return $matches;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        [$val1, $val2] = explode("\n", preg_replace('/[^\d\n]*/', '', $input));
        $generator1 = $this->getPickyGenerator(16807, 4);
        $generator2 = $this->getPickyGenerator(48271, 8);
        $matches = 0;
        for ($i = 0; $i < 5000000; $i++) {
            $val1 = $generator1($val1, true)->current();
            $val2 = $generator2($val2, true)->current();
            if (($val1 & 65535) === ($val2 & 65535)) {
                $matches++;
            }
        }
        return $matches;
    }

    /**
     * @param int $factor
     * @return \Closure
     */
    private function getGenerator(int $factor): \Closure
    {
        return function (int $value) use ($factor) {
            yield $value * $factor % 2147483647;
        };
    }

    /**
     * @param int $factor
     * @param int $mod
     * @return \Closure
     */
    private function getPickyGenerator(int $factor, int $mod): \Closure
    {
        $generator = function (int $value, bool $start = false) use (&$generator, $factor, $mod) {
            while ($start || $value % $mod !== 0) {
                $start = false;
                $value = $value * $factor % 2147483647;
                $generator($value);
            }
            yield $value;
        };
        return $generator;
    }
}
