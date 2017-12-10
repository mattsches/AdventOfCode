<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day10Test
 * @package AoC2017
 */
class Day10Test extends TestCase
{
    /**
     * @var Day10
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day10();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveFirst(string $input, int $expected)
    {
        $this->day->setList(range(0, 4));
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            ['3,4,1,5', 12],
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
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        return [
            ['', 'a2582a3a0e66e6e86e3812dcb672a272'],
            ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'],
            ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'],
            ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'],
        ];
    }
}
