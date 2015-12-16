<?php
namespace AoC;

/**
 * Interface Day
 * @package AoC
 */
interface DayInterface
{
    /**
     * @param string $input
     * @return mixed
     */
    public function solveFirst(\string $input);

    /**
     * @param string $input
     * @return mixed
     */
    public function solveSecond(\string $input);
}
