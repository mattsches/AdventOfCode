<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day4Test
 * @package AoC2017
 */
class Day4Test extends TestCase
{
    /**
     * @var Day4
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day4();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveFirst(string $input, int $expected)
    {
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            ['aa bb cc dd ee', 1],
            ['aa bb cc dd aa', 0],
            ['aa bb cc dd aaa', 1],
        ];
    }

    /**
     * @test
     * @dataProvider secondDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveSecond(string $input, int $expected)
    {
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        return [
            ['abcde fghij', 1],
            ['abcde xyz ecdab', 0],
            ['a ab abc abd abf abj', 1],
            ['iiii oiii ooii oooi oooo', 1],
            ['oiii ioii iioi iiio', 0],
        ];
    }
}
