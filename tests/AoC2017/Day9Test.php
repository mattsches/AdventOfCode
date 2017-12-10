<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day9Test
 * @package AoC2017
 */
class Day9Test extends TestCase
{
    /**
     * @var Day9
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day9();
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
            ['{}', 1],
            ['{{{}}}', 6],
            ['{{},{}}', 5],
            ['{{{},{},{{}}}}', 16],
            ['{<a>,<a>,<a>,<a>}', 1],
            ['{{<ab>},{<ab>},{<ab>},{<ab>}}', 9],
            ['{{<!!>},{<!!>},{<!!>},{<!!>}}', 9],
            ['{{<a!>},{<a!>},{<a!>},{<ab>}}', 3],
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
            ['<>', 0],
            ['<random characters>', 17],
            ['<<<<>', 3],
            ['<{!>}>', 2],
            ['<!!>', 0],
            ['<!!!>>', 0],
            ['<{o"i!a,<{i<a>', 10],
        ];
    }
}
