<?php

namespace AoC2017;

/**
 * Class Program18
 * @package AoC2017
 */
class Program18
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
    private $programCount = 0;

    /**
     * @var bool
     */
    private $terminated = false;

    /**
     * @var bool
     */
    private $waiting = false;

    /**
     * @var \SplQueue
     */
    private $receivingQueue;

    /**
     * @var \SplQueue
     */
    private $sendingQueue;

    /**
     * @var int
     */
    private $sent = 0;

    /**
     * Program18 constructor.
     * @param int $pid
     * @param array $instructions
     */
    public function __construct(int $pid, array $instructions)
    {
        $this->instructions = $instructions;
        $this->registers = array_fill_keys(range('a', 'z'), 0);
        $this->registers['p'] = $pid;
        $this->receivingQueue = new \SplQueue();
        $this->sendingQueue = new \SplQueue();
    }

    /**
     * Run until no data is waiting
     */
    public function run(): void
    {
        if ($this->terminated || $this->waiting) {
            return;
        }
        while (0 <= $this->programCount && $this->programCount < \count($this->instructions)) {
            $instr = $this->instructions[$this->programCount];
            switch ($instr[0]) {
                case 'set':
                    $this->registers[$instr[1]] = $this->getCleanValue($instr[2]);
                    break;
                case 'add':
                    $this->registers[$instr[1]] += $this->getCleanValue($instr[2]);
                    break;
                case 'mul':
                    $this->registers[$instr[1]] *= $this->getCleanValue($instr[2]);
                    break;
                case 'mod':
                    $this->registers[$instr[1]] %= $this->getCleanValue($instr[2]);
                    break;
                case 'jgz':
                    if ($this->getCleanValue($instr[1]) > 0) {
                        $this->programCount += $this->getCleanValue($instr[2]) - 1;
                    }
                    break;
                case 'rcv':
                    if ($this->receivingQueue->isEmpty()) {
                        $this->waiting = true;
                        return;
                    }
                    $this->registers[$instr[1]] = !$this->receivingQueue->isEmpty() ? $this->receivingQueue->dequeue() : null;
                    break;
                case 'snd':
                    $this->sendingQueue->enqueue($this->getCleanValue($instr[1]));
                    $this->sent++;
                    break;
            }
            $this->programCount++;
        }
        $this->terminated = true;
    }

    /**
     * @return int|null
     */
    public function getSendValue(): ?int
    {
        return !$this->sendingQueue->isEmpty() ? $this->sendingQueue->dequeue() : null;
    }

    /**
     * @param int $value
     */
    public function receive(int $value): void
    {
        $this->receivingQueue->enqueue($value);
        $this->waiting = false;
    }

    /**
     * @return bool
     */
    public function isWaiting(): bool
    {
        return $this->waiting;
    }

    /**
     * @return bool
     */
    public function isTerminated(): bool
    {
        return $this->terminated;
    }

    /**
     * @return int
     */
    public function getSent(): int
    {
        return $this->sent;
    }

    /**
     * @param string $arg
     * @return int
     */
    private function getCleanValue(string $arg): int
    {
        return is_numeric($arg) ? (int)$arg : $this->registers[$arg];
    }
}

/**
 * Class Day18
 * @package AoC2017
 */
class Day18 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $lines = explode("\n", $input);
        $linesCount = \count($lines);
        $frequency = null;
        $registers = [];
        $prevI = null;
        for ($i = 0; $i < $linesCount; $i++) {
            $parts = explode(' ', $lines[$i]);
            [$instruction, $key] = $parts;
            if (!array_key_exists($key, $registers)) {
                $registers[$key] = 0;
            }
            $value = null;
            if (array_key_exists(2, $parts)) {
                $value = $parts[2];
                if (array_key_exists($parts[2], $registers)) {
                    $value = $registers[$parts[2]];
                }
            }
            switch ($instruction) {
                case 'snd':
                    $frequency = $registers[$key];
                    break;
                case 'set':
                    $registers[$key] = $value;
                    break;
                case 'add':
                    $registers[$key] += $value;
                    break;
                case 'mul':
                    $registers[$key] *= $value;
                    break;
                case 'mod':
                    $registers[$key] %= $value;
                    break;
                case 'rcv':
                    if ($registers[$key] !== 0) {
                        $registers[$key] = $frequency;
                    }
                    break;
                case 'jgz':
                    if ($registers[$key] !== 0) {
                        $i += ($value - 1);
                    }
                    break;
            }
            if ($i + 1 === $prevI) {
                break;
            }
            $prevI = $i;
        }
        return $frequency;
    }

    /**
     * With a little help from https://www.reddit.com/r/adventofcode/comments/7kj35s/2017_day_18_solutions/drf300h/
     *
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $instructions = array_map(function ($instruction) {
            return explode(' ', $instruction);
        }, explode(PHP_EOL, trim($input)));
        $programs = [
            new Program18(0, $instructions),
            new Program18(1, $instructions)
        ];
        for ($i = 0; !$programs[0]->isTerminated() || !$programs[1]->isTerminated(); $i = !$i) {
            if ($programs[$i]->isTerminated()) {
                continue;
            }
            if ($programs[$i]->isWaiting() && ($programs[!$i]->isWaiting() || $programs[!$i]->isTerminated())) {
                break;
            }
            $programs[$i]->run();
            while ($sendValue = $programs[$i]->getSendValue()) {
                $programs[!$i]->receive($sendValue);
            }
        }
        return $programs[1]->getSent();
    }
}
