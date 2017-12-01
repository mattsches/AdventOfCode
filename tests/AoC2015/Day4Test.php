<?php

namespace AoC2015;
use PHPUnit\Framework\TestCase;

/**
 * Class Day4Test
 */
class Day4Test extends TestCase
{
    /**
     * @var Day4
     */
    protected $Day4;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->Day4 = new Day4();
    }

    /**
     * @test
     * @param string $input
     * @param int $zeroes
     * @param int $expected * @dataProvider getTestMineAdventCoinTestData
     */
    public function testMineAdventCoin(string $input, int $zeroes, int $expected)
    {
        $result = $this->Day4->mineAdventCoin($input, $zeroes);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return mixed
     */
    public function getTestMineAdventCoinTestData(): array
    {
        return [
            ['abcdef', 5, 609043],
            ['pqrstuv', 5, 1048970],
        ];
    }
}
