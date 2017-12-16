<?php

namespace AoC2017;

/**
 * Class Day16
 * @package AoC2017
 */
class Day16 implements DayInterface
{
    /**
     * @var string|array
     */
    public $programs = 'abcdefghijklmnop';

    /**
     * @var int
     */
    public $totalDances = 1000000000;

    /**
     * @param string $input
     * @return string
     */
    public function solveFirst(string $input): string
    {
        $input = trim($input);
        return implode('', $this->dance(explode(',', $input), str_split($this->programs)));
    }

    /**
     * @param string $input
     * @return string
     */
    public function solveSecond(string $input): string
    {
        $input = trim($input);
        return implode('', $this->dance(explode(',', $input), str_split($this->programs), $this->totalDances));
    }

    /**
     * @param array $commands
     * @param array $programs
     * @param int $totalDances
     * @return array
     */
    private function dance(array $commands, array $programs, int $totalDances = 1): array
    {
        $start = $programs;
        $memory = [];
        for ($i = 1; $i <= $totalDances; $i++) {
            foreach ($commands as $command) {
                $memory[$i] = $programs;
                switch ($command[0]) {
                    case 's':
                        $removed = array_splice($programs, substr($command, 1) * -1);
                        $programs = array_merge($removed, $programs);
                        break;
                    case 'x':
                        $positions = explode('/', substr($command, 1));
                        $programs = array_replace($programs, [
                            $positions[0] => $programs[$positions[1]],
                            $positions[1] => $programs[$positions[0]],
                        ]);
                        break;
                    case 'p':
                        $positions = explode('/', substr($command, 1));
                        $programs = array_replace($programs, [
                            array_search($positions[0], $programs, true) => $positions[1],
                            array_search($positions[1], $programs, true) => $positions[0],
                        ]);
                        break;
                }
            }
            if ($programs === $start) {
                $programs = $memory[$totalDances % $i];
                break;
            }
        }
        return $programs;
    }
}
