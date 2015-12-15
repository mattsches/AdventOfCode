<?php
require_once __DIR__ . '/../Day1.php';

/**
 * Class Day1Test
 */
class Day1Test extends \PHPUnit_Framework_Testcase
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
