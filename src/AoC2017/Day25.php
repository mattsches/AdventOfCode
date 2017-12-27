<?php

namespace AoC2017;

/**
 * Class TuringMachine
 * @package AoC2017
 */
class TuringMachine
{
    /**
     * @var array
     */
    private $tape;

    /**
     * @var int
     */
    private $cursor = 0;

    /**
     * @var int
     */
    private $limit = 0;

    /**
     * @var string
     */
    private $state;

    /**
     * @var array
     */
    private $states = [];

    /**
     * TuringMachine constructor.
     * @param string $blueprint
     */
    public function __construct(string $blueprint)
    {
        $this->parseBlueprint($blueprint);
        $this->tape = [0 => 0];
        $this->state = 'A'; // should probably be parsed, but whatever ;)
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return self
     */
    public function run(): self
    {
        for ($i = 1; $i <= $this->getLimit(); $i++) {
            $this->states[$this->state]->call($this, $this->state);
        }
        return $this;
    }

    /**
     * @return int
     */
    public function getChecksum(): int
    {
        return array_sum($this->tape);
    }

    /**
     * @param string $blueprint
     */
    private function parseBlueprint(string $blueprint): void
    {
        preg_match('/Perform a diagnostic checksum after (\d+) steps./', $blueprint, $m);
        $this->limit = (int)$m[1];
        $parts = \array_slice(explode("\n\n", $blueprint), 1);
        foreach ($parts as $part) {
            preg_match('/In state ([A-Z]):/', $part, $m);
            $state = $m[1];
            preg_match_all('/If the current value is (\d):\s*- Write the value (\d).\s*- Move one slot to the (left|right).\s*- Continue with state ([A-Z])./',
                $part, $m);
            $this->states[$state] = function (string $state) use ($m) {
                if (!array_key_exists($this->cursor, $this->tape)) {
                    $this->tape[$this->cursor] = 0;
                }
                if ($this->tape[$this->cursor] === (int)$m[1][0]) {
                    $this->tape[$this->cursor] = (int)$m[2][0];
                    $this->cursor += $m[3][0] === 'right' ? 1 : -1;
                    $this->state = $m[4][0];
                } elseif ($this->tape[$this->cursor] === (int)$m[1][1]) {
                    $this->tape[$this->cursor] = (int)$m[2][1];
                    $this->cursor += $m[3][1] === 'right' ? 1 : -1;
                    $this->state = $m[4][1];
                }
            };
        }
    }
}

/**
 * Class Day25
 * @package AoC2017
 */
class Day25 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        return (new TuringMachine(trim($input)))->run()->getChecksum();
    }

    /**
     * @param string $input
     */
    public function solveSecond(string $input): void
    {
        // Nothing TODO
    }
}
