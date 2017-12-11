<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day11Test
 * @package AoC2017
 */
class Day11Test extends TestCase
{
    /**
     * @var Day11
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day11();
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
            ['ne,ne,ne', 3],
            ['ne,ne,sw,sw', 0],
            ['ne,ne,s,s', 2],
            ['se,sw,se,sw,sw', 3],
        ];
    }
}
