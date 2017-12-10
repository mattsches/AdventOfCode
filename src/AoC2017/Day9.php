<?php

namespace AoC2017;

/**
 * Class Day9
 * @package AoC2017
 */
class Day9 implements DayInterface
{
    /**
     * @var int
     */
    private $score;

    /**
     * @var int
     */
    private $garbage;

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $this->score = 0;
        $this->garbage = 0;
        $this->getNumberOfGroups($input);
        return $this->score;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $this->score = 0;
        $this->garbage = 0;
        $this->getNumberOfGroups($input);
        return $this->garbage;
    }

    /**
     * @param string $input
     * @return void
     */
    private function getNumberOfGroups(string $input): void
    {
        $scoreIncrement = 1;
        $collectGarbage = false;
        $skipNextCharacter = false;
        foreach (str_split($input) as $character) {
            if ($skipNextCharacter) {
                $skipNextCharacter = false;
                continue;
            }
            switch ($character) {
                case '{':
                    if ($collectGarbage) {
                        ++$this->garbage;
                        break;
                    }
                    $this->score += $scoreIncrement;
                    ++$scoreIncrement;
                    break;
                case '}':
                    if ($collectGarbage) {
                        ++$this->garbage;
                        break;
                    }
                    --$scoreIncrement;
                    break;
                case '<':
                    if ($collectGarbage) {
                        ++$this->garbage;
                    }
                    $collectGarbage = true;
                    break;
                case '!':
                    $skipNextCharacter = true;
                    break;
                case '>':
                    $collectGarbage = false;
                    break;
                default:
                    if ($collectGarbage) {
                        ++$this->garbage;
                    }
                    break;
            }
        }
    }
}
