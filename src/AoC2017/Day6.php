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
        $numberOfBanks = \count($banks);
        $cycles = 0;
        $stateHistory = [];
        while (!\in_array($banks, $stateHistory, true)) {
            ++$cycles;
            $stateHistory[] = $banks;
            $maxBlocksOffset = array_keys($banks, max($banks))[0];
            $blocksToRedistribute = $banks[$maxBlocksOffset];
            $banks[$maxBlocksOffset] = 0;
            $iterator = new \LimitIterator(
                new \InfiniteIterator(new \ArrayIterator($banks)),
                $maxBlocksOffset + 1 % $numberOfBanks,
                $blocksToRedistribute
            );
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
        $numberOfBanks = \count($banks);
        $stateHistory = [];
        while (!\in_array($banks, $stateHistory, true)) {
            $stateHistory[] = $banks;
            $maxBlocksOffset = array_keys($banks, max($banks))[0];
            $blocksToRedistribute = $banks[$maxBlocksOffset];
            $banks[$maxBlocksOffset] = 0;
            $iterator = new \LimitIterator(
                new \InfiniteIterator(new \ArrayIterator($banks)),
                $maxBlocksOffset + 1 % $numberOfBanks,
                $blocksToRedistribute
            );
            $iterator->rewind();
            while ($iterator->valid()) {
                ++$banks[$iterator->key()];
                $iterator->next();
            }
        }
        return \count($stateHistory) - array_search($banks, $stateHistory, true);
    }
}
