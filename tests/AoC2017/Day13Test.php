<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day13Test
 * @package AoC2017
 */
class Day13Test extends TestCase
{
    /**
     * @var Day13
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day13();
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
            [
                <<<INPUT
0: 3
1: 2
4: 4
6: 4
INPUT
                ,
                24
            ],
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
            [
                <<<INPUT
0: 3
1: 2
4: 4
6: 4
INPUT
                ,
                10
            ],
        ];
    }
}
