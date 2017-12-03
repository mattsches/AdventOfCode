<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day3Test
 * @package AoC2017
 */
class Day3Test extends TestCase
{
    /**
     * @var Day3
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day3();
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
            ['1', 0],
            ['12', 3],
            ['23', 2],
            ['1024', 31],
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
            [1, 2],
            [2, 4],
            [4, 5],
            [5, 10],
            [11, 23],
            [23, 25],
        ];

    }
}
