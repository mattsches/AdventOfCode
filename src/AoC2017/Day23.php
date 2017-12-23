<?php

namespace AoC2017;

/**
 * Class Coprocessor
 * @package AoC2017
 */
class Coprocessor
{
    /**
     * @var array
     */
    private $registers;

    /**
     * @var array
     */
    private $instructions;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var int
     */
    private $mulInvokedCount = 0;

    /**
     * Coprocessor constructor.
     * @param array $instructions
     * @param int $a
     */
    public function __construct(array $instructions, $a = 0)
    {
        $this->registers = array_combine(range('a', 'h'), array_fill(0, 8, 0));
        $this->registers['a'] = $a;
        $this->instructions = $instructions;
    }

    /**
     * @param string $instruction
     */
    public function execute(string $instruction): void
    {
        $p = explode(' ', $instruction);
        if (!is_numeric($p[2])) {
            $p[2] = $this->registers[$p[2]];
        }
        $this->{$p[0]}($p[1], $p[2]);
    }

    /**
     * @return string
     * @throws \OutOfBoundsException
     */
    public function nextInstruction(): string
    {
        if ($this->offset > \count($this->instructions) - 1) {
            throw new \OutOfBoundsException('Invalid instruction offset');
        }
        return $this->instructions[$this->offset];
    }

    /**
     * @return int
     */
    public function getMulInvokedCount(): int
    {
        return $this->mulInvokedCount;
    }

    /**
     * @param string $x
     * @return int
     */
    public function getRegister(string $x): int
    {
        return $this->registers[$x];
    }

    /**
     * @param string $x
     * @param int $y
     */
    private function set(string $x, int $y): void
    {
        $this->registers[$x] = $y;
        $this->offset++;
    }

    /**
     * @param string $x
     * @param int $y
     */
    private function sub(string $x, int $y): void
    {
        $this->registers[$x] -= $y;
        $this->offset++;
    }

    /**
     * @param string $x
     * @param int $y
     */
    private function mul(string $x, int $y): void
    {
        $this->registers[$x] *= $y;
        $this->offset++;
        $this->mulInvokedCount++;
    }

    /**
     * @param $x
     * @param $y
     */
    private function jnz($x, $y): void
    {
        if ((is_numeric($x) && $x !== 0) || $this->registers[$x] !== 0) {
            $this->offset += $y;
        } else {
            $this->offset++;
        }
    }
}

/**
 * Class Day23
 * @package AoC2017
 */
class Day23 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $coprocessor = new Coprocessor(explode(PHP_EOL, trim($input)));
        while (true) {
            try {
                $coprocessor->execute($coprocessor->nextInstruction());
            } catch (\OutOfBoundsException $e) {
                break;
            }
        }
        return $coprocessor->getMulInvokedCount();
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $c = 124900;
        $h = 0;
        foreach (range(107900, $c + 1, 17) as $b) {
            if (!gmp_prob_prime($b)) {
                ++$h;
            }
        }
        return $h;
    }
}
