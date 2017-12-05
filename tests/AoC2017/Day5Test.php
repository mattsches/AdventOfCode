<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day5Test
 * @package AoC2017
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
            [<<<INPUT
0
3
0
1
-3
INPUT
                , 5
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
            [<<<INPUT
0
3
0
1
-3
INPUT
                , 10
            ],
        ];
    }
}
