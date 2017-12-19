<?php

namespace AoC2017;

/**
 * Class Day19
 * @package AoC2017
 */
class Day19 implements DayInterface
{
    /**
     * @var
     */
    private $direction;

    /**
     * @var
     */
    private $letters;

    /**
     * @var int
     */
    private $steps;

    /**
     * @var array
     */
    private $grid;

    /**
     * @var array
     */
    private $az;

    /**
     * @param string $input
     * @return string
     */
    public function solveFirst(string $input): string
    {
        foreach (explode("\n", $input) as $i => $line) {
            foreach (str_split($line) as $j => $cell) {
                $this->grid[$i][$j] = $cell;
            }
        }
        $this->az = range('A', 'Z');
        $this->letters = '';
        $this->steps = 1;
        $move = [0, array_search('|', $this->grid[0], true)];
        $this->direction = 's';
        while (\is_array($move)) {
            $move = $this->findNext($move);
        }
        return $this->letters;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        return $this->steps;
    }

    /**
     * @param array $pos
     * @return array|null
     */
    private function findNext(array $pos): ?array
    {
        $options = [
            'n' => [$pos[0] - 1, $pos[1]],
            'e' => [$pos[0], $pos[1] + 1],
            's' => [$pos[0] + 1, $pos[1]],
            'w' => [$pos[0], $pos[1] - 1],
            'n2' => [$pos[0] - 2, $pos[1]],
            'e2' => [$pos[0], $pos[1] + 2],
            's2' => [$pos[0] + 2, $pos[1]],
            'w2' => [$pos[0], $pos[1] - 2],
        ];
        uksort($options, function ($a, $b) {
            if ($a === $this->direction) {
                return -1;
            }
            if ($b === $this->direction) {
                return 1;
            }
            return 0;
        });
        $move = null;
        foreach ($options as $key => $o) {
            if (($key === 'n' && $this->direction === 's')
                || ($key === 's' && $this->direction === 'n')
                || ($key === 'e' && $this->direction === 'w')
                || ($key === 'w' && $this->direction === 'e')
                || !array_key_exists($o[0], $this->grid)
                || !array_key_exists($o[1], $this->grid[$o[0]])
                || !\in_array($key, ['n', 'e', 's', 'w'], true)
            ) {
                continue;
            }
            $move = $this->getNextMove($options, $o, $key);
            if ($move !== null) {
                $this->direction = $key;
            }
            if ($move !== null) {
                return $move;
            }
        }
        return $move;
    }

    /**
     * @param array $options
     * @param array $o
     * @param string $dir
     * @return array|null
     */
    private function getNextMove(array $options, array $o, string $dir): ?array
    {
        $move = null;
        $next = $this->grid[$o[0]][$o[1]];
        $nboKey = $dir . '2';
        $nextButOne = null;
        if (array_key_exists($options[$nboKey][0], $this->grid)
            && array_key_exists($options[$nboKey][1], $this->grid[$options[$nboKey][0]])
        ) {
            $nextButOne = $this->grid[$options[$nboKey][0]][$options[$nboKey][1]];
        }
        $symbols = \in_array($dir, ['n', 's'], true) ? ['|', '+'] : ['-', '+'];
        $haystack = array_merge($this->az, $symbols);
        if (\in_array($next, $haystack, true)) {
            $move = $o;
            $this->addLetter($next);
            $this->steps++;
        } elseif ($next !== ' ' && \in_array($nextButOne, $haystack, true)) {
            $move = [$options[$nboKey][0], $options[$nboKey][1]];
            $this->addLetter($nextButOne);
            $this->steps += 2;
        }
        return $move;
    }

    /**
     * @param string $character
     */
    private function addLetter(string $character): void
    {
        if (\in_array($character, $this->az, true)) {
            $this->letters .= $character;
        }
    }
}
