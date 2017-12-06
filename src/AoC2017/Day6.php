<?php

namespace AoC2017;

/**
 * Class Day6
 * @package AoC2017
 */
class Day6 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $banks = preg_split("/[\s]/", $input);
        $cycles = 0;
        $stateHistory = [];
        while (!\in_array($banks, $stateHistory, true)) {
            ++$cycles;
            $stateHistory[] = $banks;
            $maxBlocksOffset = array_keys($banks, max($banks))[0];
            $count = $banks[$maxBlocksOffset];
            $banks[$maxBlocksOffset] = 0;
            $offset = $maxBlocksOffset === \count($banks) - 1 ? 0 : $maxBlocksOffset + 1;
            $iterator = new \LimitIterator(new \InfiniteIterator(new \ArrayIterator($banks)), $offset, $count);
            $iterator->rewind();
            while ($iterator->valid()) {
                ++$banks[$iterator->key()];
                $iterator->next();
            }
        }
        return $cycles;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $banks = preg_split("/[\s]/", $input);
        $cycles = 0;
        $stateHistory = [];
        $infiniteLoopDetected = false;
        while (!\in_array($banks, $stateHistory, true)) {
            ++$cycles;
            $stateHistory[] = $banks;
            $maxBlocksOffset = array_keys($banks, max($banks))[0];
            $count = $banks[$maxBlocksOffset];
            $banks[$maxBlocksOffset] = 0;
            $offset = $maxBlocksOffset === \count($banks) - 1 ? 0 : $maxBlocksOffset + 1;
            $iterator = new \LimitIterator(new \InfiniteIterator(new \ArrayIterator($banks)), $offset, $count);
            $iterator->rewind();
            while ($iterator->valid()) {
                ++$banks[$iterator->key()];
                $iterator->next();
            }
            if ($infiniteLoopDetected === false && \in_array($banks, $stateHistory, true)) {
                $infiniteLoopDetected = true;
                $cycles = 0;
                $stateHistory = [];
            }
        }
        return $cycles;
    }
}
