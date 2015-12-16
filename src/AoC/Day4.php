<?php
namespace AoC;

/**
 * Class Day4
 * @package AoC
 */
class Day4 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(\string $input)
    {
        return $this->mineAdventCoin($input);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(\string $input)
    {
        return $this->mineAdventCoin($input, 6);
    }

    /**
     * @param string $secret
     * @param int $zeroes
     * @return int
     */
    public function mineAdventCoin(\string $secret, \int $zeroes = 5): \int
    {
        $number = 0;
        foreach ($this->generateNumber() as $number) {
            $hash = $this->generateHash($secret, $number);
            if (strncmp($hash, str_repeat('0', $zeroes), $zeroes) === 0) {
                break;
            }
        }

        return $number;
    }

    /**
     * @return \Generator
     */
    private function generateNumber(): \Generator
    {
        for ($number = 1; $number <= PHP_INT_MAX; $number++) {
            yield $number;
        }
    }

    /**
     * @param string $secret
     * @param int $number
     * @return string
     */
    private function generateHash(\string $secret, \int $number): \string
    {
        return md5($secret . $number);
    }
}
