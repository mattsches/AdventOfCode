<?php
namespace AoC;

/**
 * Class Day2Test
 */
class Day2Test extends \PHPUnit_Framework_Testcase
{
    /**
     * @var Day2
     */
    protected $Day2;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->Day2 = new Day2();
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getTestGetTotalSquareFeetTestData
     */
    public function testGetTotalSquareFeet(\string $input, \int $expected)
    {
        $result = $this->Day2->getTotalSquareFeet($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function getTestGetTotalSquareFeetTestData(): array
    {
        return [
            ['2x3x4', 58],
            ['1x1x10', 43],
        ];
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getRibbonData
     */
    public function testGetFeet(\string $input, \int $expected)
    {
        $result = $this->Day2->getRibbonLength($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return mixed
     */
    public function getRibbonData(): array
    {
        return [
            ['2x3x4', 34],
            ['1x1x10', 14],
        ];
    }
}
