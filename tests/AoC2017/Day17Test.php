<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day17Test
 * @package AoC2017
 */
class Day17Test extends TestCase
{
    /**
     * @var Day17
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day17();
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
            ['3', 638],
        ];
    }
}
