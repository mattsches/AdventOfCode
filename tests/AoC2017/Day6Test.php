<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day6Test
 * @package AoC2017
 */
class Day6Test extends TestCase
{
    /**
     * @var Day6
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day6();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param int $expectedCycles
     */
    public function itShouldSolveFirst(string $input, int $expectedCycles)
    {
        $this->assertSame($expectedCycles, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            ['0 2 7 0', 5],
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
            ['0 2 7 0', 4],
        ];
    }
}
