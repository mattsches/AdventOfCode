<?php

namespace AoC2018;

use PHPUnit\Framework\TestCase;

/**
 * Class Day2Test
 * @package AoC2018
 */
class Day2Test extends TestCase
{
    /**
     * @var Day2
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day2();
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
abcdef
bababc
abbcde
abcccd
aabcdd
abcdee
ababab
EOT;

        return [
            [
                $input,
                12
            ],
        ];
    }

    /**
     * @test
     * @dataProvider secondDataProvider
     * @param string $input
     * @param string $expected
     */
    public function itShouldSolveSecond(string $input, string $expected): void
    {
        $this->assertSame($expected, $this->day->solveSecond($input));
    }

    /**
     * @return array
     */
    public function secondDataProvider(): array
    {
        $input = <<<EOT
abcde
fghij
klmno
pqrst
fguij
axcye
wvxyz
EOT;

        return [
            [$input, 'fgij'],
        ];
    }
}
