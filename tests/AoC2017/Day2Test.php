<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day2Test
 * @package AoC2017
 */
class Day2Test extends TestCase
{
    /**
     * @var Day2
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day2();
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
            [<<<INPUT
5 1 9 5
7 5 3
2 4 6 8
INPUT
                , 18],
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
            [<<<INPUT
5 9 2 8
9 4 7 3
3 8 6 5
INPUT
                , 9],
        ];

    }
}
