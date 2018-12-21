<?php

namespace AoC2018;

use PHPUnit\Framework\TestCase;

/**
 * Class Day6Test
 * @package AoC2018
 */
class Day6Test extends TestCase
{
    /**
     * @var Day6
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day6();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveFirst(string $input, int $expected): void
    {
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        $input = <<<EOT
            1, 1
            1, 6
            8, 3
            3, 4
            5, 5
            8, 9
            EOT;

        return [
            [$input, 17],
        ];
    }

    /**
     * @test
     * @dataProvider secondDataProvider
     * @param string $input
     * @param int $expected
     */
    public function itShouldSolveSecond(string $input, int $expected): void
    {
        $this->assertSame($expected, $this->day->solveSecond($input, 32));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        $input = <<<EOT
            1, 1
            1, 6
            8, 3
            3, 4
            5, 5
            8, 9
            EOT;

        return [
            [$input, 16],
        ];
    }
}
