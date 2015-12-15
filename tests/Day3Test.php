<?php
require_once __DIR__ . '/../Day3.php';

/**
 * Class Day3Test
 */
class Day3Test extends \PHPUnit_Framework_Testcase
{
    /**
     * @var Day3
     */
    protected $Day3;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->Day3 = new Day3();
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getTestGetUniqueHousesTestData
     */
    public function testGetUniqueHouses(string $input, int $expected)
    {
        $result = $this->Day3->getUniqueHouses($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function getTestGetUniqueHousesTestData(): array
    {
        return [
            ['>', 2],
            ['^>v<', 4],
            ['^v^v^v^v^v', 2],
        ];
    }

    /**
     * @test
     * @param string $input
     * @param int $expected
     * @dataProvider getTestGetUniqueHousesWithRobotSantaTestData
     */
    public function testGetUniqueHousesWithRobotSanta(string $input, int $expected)
    {
        $this->assertEquals($expected, $this->Day3->getUniqueHousesWithRobotSanta($input));
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function getTestGetUniqueHousesWithRobotSantaTestData()
    {
        return [
            ['^v', 3],
            ['^>v<', 3],
            ['^v^v^v^v^v', 11],
        ];
    }
}
