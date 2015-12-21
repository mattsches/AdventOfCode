<?php
declare(strict_types=1);
namespace AoC;

/**
 * Class Day5
 * @package AoC
 */
class Day5 implements DayInterface
{
    /**
     * @param mixed $input
     * @return int
     */
    public function solveFirst(\string $input): \int
    {
        $counter = 0;
        foreach (explode("\n", $input) as $line) {
            if ($this->isStringNice($line)) {
                $counter++;
            }
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
        foreach (explode("\n", $input) as $line) {
            if ($this->isStringNiceNew($line)) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * @param string $input
     * @return bool
     */
    public function isStringNice(\string $input): \bool
    {
        $isNice = false;

        if ($this->containsVowels($input)
            && $this->hasTwiceInARowLetter($input)
            && $this->hasNotForbiddenStrings($input)
        ) {
            $isNice = true;
        }

        return $isNice;
    }

    /**
     * @param string $input
     * @return bool
     */
    public function isStringNiceNew(\string $input): \bool
    {
        $isNice = false;

        if ($this->containsPairOfLettersTwice($input)
            && $this->containsRepeatedLetterBetween($input)
        ) {
            $isNice = true;
        }

        return $isNice;
    }

    /**
     * @param string $input
     * @return bool
     */
    public function containsPairOfLettersTwice(\string $input): \bool
    {
        return (preg_match('/\b\w*(\w{2})\w*\1/i', $input) === 1);
    }

    /**
     * @param $input
     * @return bool
     */
    private function containsVowels(\string $input): \bool
    {
        return (preg_match_all('/[aeiou]/i', $input, $matches) >= 3);
    }

    /**
     * @param $input
     * @return bool
     */
    private function hasTwiceInARowLetter(\string $input): \bool
    {
        return (preg_match('/(.)\1/i', $input) === 1);
    }

    /**
     * @param string $input
     * @return bool
     */
    private function hasNotForbiddenStrings(\string $input): \bool
    {
        return (preg_match('/(ab|cd|pq|xy)/i', $input) === 0);
    }

    /**
     * @param string $input
     * @return bool
     */
    private function containsRepeatedLetterBetween(\string $input): \bool
    {
        return (preg_match('/(.)(.)\1/i', $input) === 1);
    }
}
