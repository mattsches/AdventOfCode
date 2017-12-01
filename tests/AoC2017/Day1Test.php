<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day1Test
 * @package AoC2017
 */
class Day1Test extends TestCase
{
    /**
     * @var Day1
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day1();
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
            ['1122', 3],
            ['1111', 4],
            ['1234', 0],
            ['91212129', 9],
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
            ['1212', 6],
            ['1221', 0],
            ['123425', 4],
            ['123123', 12],
            ['12131415', 4],
        ];

    }
}
