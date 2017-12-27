<?php

namespace AoC2017;

/**
 * Class Image
 * @package AoC2017
 */
class Image
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * @var int
     */
    private $iterations;

    /**
     * @var array
     */
    private $rules;

    /**
     * Image constructor.
     * @param string $input
     * @param int $iterations
     */
    public function __construct(string $input, int $iterations)
    {
        $this->initRules($input);
        $this->pattern = '.#./..#/###';
        $this->iterations = $iterations;
    }

    /**
     *
     */
    public function run(): void
    {
        for ($i = 0; $i < $this->iterations; $i++) {
            $gridSize = sqrt(\strlen($this->pattern) - substr_count($this->pattern, '/'));
            $squareSize = 3;
            if ($gridSize % 2 === 0) {
                $squareSize = 2;
            }
            $parts = $this->getParts($gridSize, $squareSize);
            $results = [];
            foreach ($parts as $part) {
                foreach ($this->getVariations($part) as $variation) {
                    if (array_key_exists($variation, $this->rules)) {
                        $results[] = $this->rules[$variation];
                        break;
                    }
                }
            }
            $this->pattern = $this->recombine($results, $gridSize, $squareSize);
        }
    }

    /**
     * @return int
     */
    public function getOnPixelsCount(): int
    {
        return substr_count($this->pattern, '#');
    }

    /**
     * @param string $input
     */
    private function initRules(string $input): void
    {
        $lines = explode(PHP_EOL, trim($input));
        $this->rules = [];
        foreach ($lines as $line) {
            if (preg_match('|(.*) => (.*)|', $line, $matches)) {
                $this->rules[$matches[1]] = $matches[2];
            }
        }
    }

    /**
     * @param array $results
     * @param int $gridSize
     * @param int $squareSize
     * @return string
     */
    private function recombine(array $results, int $gridSize, int $squareSize): string
    {
        $newParts = [];
        $newSquareSize = $squareSize + 1;
        $counter = 0;
        for ($i = 0; $i < $gridSize / $squareSize; $i++) {
            for ($j = 0; $j < $gridSize / $squareSize; $j++) {
                if (!array_key_exists($counter, $results)) {
                    continue;
                }
                $r = explode('/', $results[$counter]);
                for ($k = 0; $k < $newSquareSize; $k++) {
                    $offset = ($i * $newSquareSize) + $k;
                    if (!array_key_exists($offset, $newParts)) {
                        $newParts[$offset] = '';
                    }
                    $newParts[$offset] .= $r[$k];
                }
                $counter++;
            }
        }
        return implode('/', $newParts);
    }

    /**
     * @param string $part
     * @return array
     */
    private function getVariations(string $part): array
    {
        $variations = [];
        $variations[] = $part;
        $variations[] = $this->rotate($variations[0]);
        $variations[] = $this->rotate($variations[1]);
        $variations[] = $this->rotate($variations[2]);
        $variations[] = $this->flip($variations[0]);
        $variations[] = $this->flip($variations[1]);
        $variations[] = $this->flip($variations[2]);
        $variations[] = $this->flip($variations[3]);
        return $variations;
    }

    /**
     * @param string $pattern
     * @return string
     */
    private function rotate(string $pattern): string
    {
        if (\strlen($pattern) === 11) {
            $rotatedPattern = '.../.../...';
            $rotatedPattern[0] = $pattern[8];
            $rotatedPattern[1] = $pattern[4];
            $rotatedPattern[2] = $pattern[0];
            $rotatedPattern[4] = $pattern[9];
            $rotatedPattern[5] = $pattern[5];
            $rotatedPattern[6] = $pattern[1];
            $rotatedPattern[8] = $pattern[10];
            $rotatedPattern[9] = $pattern[6];
            $rotatedPattern[10] = $pattern[2];
        } else {
            $rotatedPattern = '../..';
            $rotatedPattern[0] = $pattern[3];
            $rotatedPattern[1] = $pattern[0];
            $rotatedPattern[3] = $pattern[4];
            $rotatedPattern[4] = $pattern[1];
        }
        return $rotatedPattern;
    }

    /**
     * @param string $pattern
     * @return string
     */
    private function flip(string $pattern): string
    {
        if (\strlen($pattern) === 11) {
            $flippedPattern = '.../.../...';
            $flippedPattern[0] = $pattern[2];
            $flippedPattern[1] = $pattern[1];
            $flippedPattern[2] = $pattern[0];
            $flippedPattern[4] = $pattern[6];
            $flippedPattern[5] = $pattern[5];
            $flippedPattern[6] = $pattern[4];
            $flippedPattern[8] = $pattern[10];
            $flippedPattern[9] = $pattern[9];
            $flippedPattern[10] = $pattern[8];
        } else {
            $flippedPattern = '../..';
            $flippedPattern[0] = $pattern[1];
            $flippedPattern[1] = $pattern[0];
            $flippedPattern[3] = $pattern[4];
            $flippedPattern[4] = $pattern[3];
        }
        return $flippedPattern;
    }

    /**
     * @param int $gridSize
     * @param int $squareSize
     * @return array
     */
    private function getParts(int $gridSize, int $squareSize): array
    {
        $parts = [];
        $rows = explode('/', $this->pattern);
        for ($p1 = 0; $p1 < $gridSize / $squareSize; $p1++) { // block-row per row
            for ($p2 = 0; $p2 < $gridSize / $squareSize; $p2++) { // block-col per col in this row
                $part = [];
                for ($r = $p1 * $squareSize; $r < ($p1 * $squareSize) + $squareSize; $r++) {
                    $part[] = substr($rows[$r], $p2 * $squareSize, $squareSize);
                }
                $parts[] = implode('/', $part);
            }
        }
        return $parts;
    }
}

/**
 * Class Day21
 * @package AoC2017
 */
class Day21 implements DayInterface
{
    /**
     * @var int
     */
    public $iterations = 5;

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $image = new Image($input, $this->iterations);
        $image->run();
        return $image->getOnPixelsCount();
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $image = new Image($input, 18);
        $image->run();
        return $image->getOnPixelsCount();
    }
}
