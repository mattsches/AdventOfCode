<?php

/**
 * Class Day4
 */
class Day4
{
    /**
     * @param string $secret
     * @param int $zeroes
     * @return int
     */
    public function mineAdventCoin(string $secret, int $zeroes = 5): int
    {
        $number = 0;
        foreach ($this->generateNumber() as $number) {
            $hash = $this->generateHash($secret, $number);
            if (strncmp($hash, str_repeat('0', $zeroes), $zeroes) === 0) {
                break;
            }
        }

        return $number;
    }

    /**
     * @return Generator
     */
    private function generateNumber(): Generator
    {
        for ($number = 1; $number <= PHP_INT_MAX; $number++) {
            yield $number;
        }
    }

    /**
     * @param string $secret
     * @param int $number
     * @return string
     */
    private function generateHash(string $secret, int $number): string
    {
        return md5($secret . $number);
    }
}

$input = 'bgvyzdsv';
$day4 = new Day4();
$result = $day4->mineAdventCoin($input);
echo ' 4.1 => ' . $result . PHP_EOL;

$result = $day4->mineAdventCoin($input, 6);
echo ' 4.2 => ' . $result . PHP_EOL;
