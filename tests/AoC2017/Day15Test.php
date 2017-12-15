<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day15Test
 * @package AoC2017
 */
class Day15Test extends TestCase
{
    /**
     * @var Day15
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day15();
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
Generator A starts with 65
Generator B starts with 8921
INPUT
                ,
                588
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
Generator A starts with 65
Generator B starts with 8921
INPUT
                ,
                309
            ],
        ];
    }
}
