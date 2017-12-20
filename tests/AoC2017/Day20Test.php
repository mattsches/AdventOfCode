<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day20Test
 * @package AoC2017
 */
class Day20Test extends TestCase
{
    /**
     * @var Day20
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day20();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param string $expected
     */
    public function itShouldSolveFirst(string $input, string $expected)
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
p=< 3,0,0>, v=< 2,0,0>, a=<-1,0,0>
p=< 4,0,0>, v=< 0,0,0>, a=<-2,0,0>
INPUT
                ,
                0
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
p=<-6,0,0>, v=< 3,0,0>, a=< 0,0,0>    
p=<-4,0,0>, v=< 2,0,0>, a=< 0,0,0>
p=<-2,0,0>, v=< 1,0,0>, a=< 0,0,0>
p=< 3,0,0>, v=<-1,0,0>, a=< 0,0,0>
INPUT
                ,
                1
            ],
        ];
    }
}
