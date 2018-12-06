<?php

namespace AoC2018;

use PHPUnit\Framework\TestCase;

/**
 * Class Day5Test
 * @package AoC2018
 */
class Day5Test extends TestCase
{
    /**
     * @var Day5
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day5();
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
            ['dabAcCaCBAcCcaDA', 10],
        ];
    }

    /**
     * @test
     * @dataProvider secondDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveSecond(string $input, int $expected): void
    {
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        return [
            ['dabAcCaCBAcCcaDA', 4],
        ];
    }
}
