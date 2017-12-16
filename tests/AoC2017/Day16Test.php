<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day16Test
 * @package AoC2017
 */
class Day16Test extends TestCase
{
    /**
     * @var Day16
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day16();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param string $expected
     */
    public function itShouldSolveFirst(string $input, string $expected)
    {
        $this->day->programs = 'abcde';
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            ['s1,x3/4,pe/b', 'baedc'],
        ];
    }

    /**
     * @test
     * @dataProvider secondDataProvider
     * @param string $input
     * @param string $expected
     */
    public function itShouldSolveSecond(string $input, string $expected)
    {
        $this->day->programs = 'abcde';
        $this->day->totalDances = 2;
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        return [
            ['s1,x3/4,pe/b', 'ceadb'],
        ];
    }
}
