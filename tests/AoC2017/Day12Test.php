<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day12Test
 * @package AoC2017
 */
class Day12Test extends TestCase
{
    /**
     * @var Day12
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day12();
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
0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5
INPUT
                , 6
            ],
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
            [<<<INPUT
0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5
INPUT
                , 2
            ],
        ];
    }
}
