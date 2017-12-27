<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day21Test
 * @package AoC2017
 */
class Day21Test extends TestCase
{
    /**
     * @var Day21
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day21();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveFirst(string $input, int $expected)
    {
        $this->day->iterations = 2;
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
../.# => ##./#../...
.#./..#/### => #..#/..../..../#..#
INPUT
                ,
                12
            ],
        ];
    }
}
