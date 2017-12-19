<?php

namespace AoC2017;

use PHPUnit\Framework\TestCase;

/**
 * Class Day19Test
 * @package AoC2017
 */
class Day19Test extends TestCase
{
    /**
     * @var Day19
     */
    protected $day;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day = new Day19();
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
            [
                <<<INPUT
     |          
     |  +--+    
     A  |  C    
 F---|----E|--+ 
     |  |  |  D 
     +B-+  +--+ 
INPUT
                ,
                'ABCDEF'
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
        $this->day->solveFirst($input);
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
     |          
     |  +--+    
     A  |  C    
 F---|----E|--+ 
     |  |  |  D 
     +B-+  +--+ 
INPUT
                ,
                38
            ],
        ];
    }
}
