<?php

namespace AoC2015;
use PHPUnit\Framework\TestCase;

/**
 * Class Day6Test
 */
class Day6Test extends TestCase
{
    /**
     * @var Day6
     */
    protected $Day6;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->Day6 = new Day6();
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getTestIsStringNiceTestData
     */
    public function testIsStringNice(string $input, int $expected)
    {
        $result = $this->Day6->solveFirst($input);
        $this->assertEquals($expected, $result, $input);
    }

    /**
     * @return mixed
     */
    public function getTestIsStringNiceTestData(): array
    {
        return [
            ['turn on 0,0 through 999,999', 1000000],
            ['toggle 0,0 through 999,0', 1000],
            ['turn off 499,499 through 500,500', 0],
        ];
    }
}
