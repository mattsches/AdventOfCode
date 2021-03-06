<?php

namespace AoC2015;
use PHPUnit\Framework\TestCase;

/**
 * Class Day1Test
 * @package AoC2015
 */
class Day1Test extends TestCase
{
    /**
     * @var Day1
     */
    protected $day1;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->day1 = new Day1();
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getTestGetFloorTestData
     */
    public function testGetFloor(string $input, int $expected)
    {
        $result = $this->day1->getFloor($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function getTestGetFloorTestData(): array
    {
        return [
            ['(())', 0],
            ['()()', 0],
            ['(((', 3],
            ['(()(()(', 3],
            ['())', -1],
            ['))(', -1],
            [')))', -3],
            [')())())', -3],
        ];
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getTestGetBasementPositionTestData
     */
    public function testGetBasementPosition(string $input, int $expected)
    {
        $result = $this->day1->getBasementPosition($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function getTestGetBasementPositionTestData(): array
    {
        return [
            [')', 1],
            ['()())', 5],
        ];
    }
}
