<?php

namespace AoC2017;

/**
 * Class Day10
 * @package AoC2017
 */
class Day10 implements DayInterface
{
    /**
     * @var array
     */
    private $list;

    /**
     * Day10 constructor.
     */
    public function __construct()
    {
        $this->list = range(0, 255);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $list = $this->list;
        $listIterator = $this->getListIterator($list);
        $skipSize = 0;
        $currentPosition = 0;
        foreach (explode(',', $input) as $length) {
            $selected = [];
            for ($i = 0; $i < $length; $i++) {
                $selected[$listIterator->key()] = $listIterator->current();
                $listIterator->next();
            }
            $list = array_replace($list, array_combine(array_keys($selected), array_reverse($selected)));
            $listIterator = $this->getListIterator($list);
            $currentPosition = ($currentPosition + $length + $skipSize) % \count($list);
            for ($i = 0; $i < $currentPosition; $i++) { //ffwd
                $listIterator->next();
            }
            ++$skipSize;
        }
        return $list[0] * $list[1];
    }

    /**
     * @param string $input
     * @return string
     */
    public function solveSecond(string $input): string
    {
        $suffix = implode(',', [17, 31, 73, 47, 23]);
        $inputArray = array_map(function ($n) {
            return \ord($n);
        }, str_split(trim($input)));
        $lengthsArray = !empty($input) ? implode(',', $inputArray) . ',' . $suffix : $suffix;
        $list = $this->list;
        $listIterator = $this->getListIterator($list);
        $skipSize = 0;
        $currentPosition = 0;
        for ($i = 0; $i < 64; $i++) {
            foreach (explode(',', $lengthsArray) as $length) {
                $selected = [];
                for ($k = 0; $k < $length; $k++) {
                    $selected[$listIterator->key()] = $listIterator->current();
                    $listIterator->next();
                }
                $list = array_replace($list, array_combine(array_keys($selected), array_reverse($selected)));
                $listIterator = $this->getListIterator($list);
                $currentPosition = ($currentPosition + $length + $skipSize) % \count($list);
                for ($j = 0; $j < $currentPosition; $j++) { //ffwd
                    $listIterator->next();
                }
                ++$skipSize;
            }
        }
        $denseHash = [];
        for ($i = 0; $i < 16; $i++) {
            $denseHash[] = sprintf('%02s',
                dechex(array_reduce(\array_slice($list, $i * 16, 16), function ($carry, $item) {
                    $carry ^= $item;
                    return $carry;
                })));
        }
        return implode('', $denseHash);
    }

    /**
     * Setter just for the unit tests, but hey, it's just a game ;-)
     * @param array $list
     */
    public function setList(array $list)
    {
        $this->list = $list;
    }

    /**
     * @param array $list
     * @return \InfiniteIterator
     */
    private function getListIterator(array $list): \InfiniteIterator
    {
        $listIterator = new \InfiniteIterator(new \ArrayIterator($list));
        $listIterator->rewind();
        return $listIterator;
    }
}
