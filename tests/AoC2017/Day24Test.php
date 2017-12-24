<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day24Test
 * @package AoC2017
 */
class Day24Test extends TestCase
{
    /**
     * @var Day24
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day24();
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
0/2
2/2
2/3
3/4
3/5
0/1
10/1
9/10
INPUT
                ,
                31
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
0/2
2/2
2/3
3/4
3/5
0/1
10/1
9/10
INPUT
                ,
                19
            ],
        ];
    }
}
