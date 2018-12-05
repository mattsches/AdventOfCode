<?php

namespace AoC2018;

use PHPUnit\Framework\TestCase;

/**
 * Class Day3Test
 * @package AoC2018
 */
class Day3Test extends TestCase
{
    /**
     * @var Day3
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day3();
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
#1 @ 1,3: 4x4
#2 @ 3,1: 4x4
#3 @ 5,5: 2x2
EOT;

        return [
            [
                $input,
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
    public function itShouldSolveSecond(string $input, int $expected): void
    {
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        $input = <<<EOT
#1 @ 1,3: 4x4
#2 @ 3,1: 4x4
#3 @ 5,5: 2x2
EOT;

        return [
            [$input, 3],
        ];
    }
}
