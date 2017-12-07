<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day7Test
 * @package AoC2017
 */
class Day7Test extends TestCase
{
    /**
     * @var Day7
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day7();
    }

    /**
     * @test
     * @dataProvider firstDataProvider
     * @param string $input
     * @param string $expected
     */
    public function itShouldSolveFirst(string $input, string $expected)
    {
        $this->assertSame($expected, $this->day->solveFirst($input));
    }

    /**
     * @return array
     */
    public function firstDataProvider(): array
    {
        return [
            [<<<INPUT
pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)
INPUT
                , 'tknk'
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
            [<<<INPUT
pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)
INPUT
                , 60
],
        ];
    }
}
