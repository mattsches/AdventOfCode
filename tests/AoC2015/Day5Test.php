<?php

namespace AoC2015;
use PHPUnit\Framework\TestCase;

/**
 * Class Day5Test
 */
class Day5Test extends TestCase
{
    /**
     * @var Day5
     */
    protected $Day5;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->Day5 = new Day5();
    }

    /**
     * @test
     * @param string $input
     * @param bool $expected
     * @dataProvider getTestIsStringNiceTestData
     */
    public function testIsStringNice(string $input, bool $expected)
    {
        $result = $this->Day5->isStringNice($input);
        $this->assertEquals($expected, $result, $input);
    }

    /**
     * @return mixed
     */
    public function getTestIsStringNiceTestData(): array
    {
        return [
            ['ugknbfddgicrmopn', true],
            ['aaa', true],
            ['jchzalrnumimnmhp', false],
            ['haegwjzuvuyypxyu', false],
            ['dvszwmarrgswjxmb', false],
        ];
    }

    /**
     * @test
     * @param string $input
     * @param bool $expected
     * @dataProvider getTestIsStringNiceNewTestData
     */
    public function testIsStringNiceNew(string $input, bool $expected)
    {
        $result = $this->Day5->isStringNiceNew($input);
        $this->assertEquals($expected, $result, $input);
    }

    /**
     * @return mixed
     */
    public function getTestIsStringNiceNewTestData(): array
    {
        return [
            ['qjhvhtzxzqqjkmpb', true],
            ['xxyxx', true],
            ['uurcxstgmygtbstg', false],
            ['ieodomkazucvgmuy', false],
        ];
    }
}
