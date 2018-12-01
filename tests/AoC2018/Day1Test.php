<?php

namespace AoC2018;

use PHPUnit\Framework\TestCase;

/**
 * Class Day1Test
 * @package AoC2018
 */
class Day1Test extends TestCase
{
    /**
     * @var Day1
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day1();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveFirst(string $input, int $expected): void
    {
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            ['+1, +1, +1', 3],
            ['+1, +1, -2', 0],
            ['-1, -2, -3', -6],
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
            ['+1, -1', 0],
            ['+3, +3, +4, -2, -4', 10],
            ['-6, +3, +8, +5, -6', 5],
            ['+7, +7, -2, -7, -4', 14],
        ];

    }
}
