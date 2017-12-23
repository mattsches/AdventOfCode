<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day22Test
 * @package AoC2017
 */
class Day22Test extends TestCase
{
    /**
     * @var Day22
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day22();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param int $bursts
     * @param int $expected
     */
    public function itShouldSolveFirst(int $bursts, int $expected)
    {
        $input = <<<INPUT
..#
#..
...
INPUT;
        $this->day->bursts = $bursts;
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            [7, 5],
            [70, 41],
            [10000, 5587],
        ];
    }

    /**
     * @test
     * @dataProvider secondDataProvider
     * @param string $bursts
     * @param int $expected
     */
    public function itShouldSolveSecond(string $bursts, int $expected)
    {
        $input = <<<INPUT
..#
#..
...
INPUT;
        $this->day->bursts = $bursts;
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        return [
            [100, 26],
            [10000000, 2511944],
        ];
    }
}
