<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day8Test
 * @package AoC2017
 */
class Day8Test extends TestCase
{
    /**
     * @var Day8
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day8();
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
b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10
INPUT
                ,
                1
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
b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10
INPUT
                ,
                10
            ],
        ];
    }
}
