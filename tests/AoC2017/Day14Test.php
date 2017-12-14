<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day14Test
 * @package AoC2017
 */
class Day14Test extends TestCase
{
    /**
     * @var Day14
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day14();
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
            ['flqrgnkx', 8108],
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
            ['flqrgnkx', 1242],
        ];
    }
}
