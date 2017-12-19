<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day18Test
 * @package AoC2017
 */
class Day18Test extends TestCase
{
    /**
     * @var Day18
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day18();
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
set a 1
add a 2
mul a a
mod a 5
snd a
set a 0
rcv a
jgz a -1
set a 1
jgz a -2
INPUT
                ,
                4
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
snd 1
snd 2
snd p
rcv a
rcv b
rcv c
rcv d
INPUT
                ,
                3
            ],
        ];
    }
}
