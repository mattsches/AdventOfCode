<?php

namespace AoC2017;

/**
 * Class CarrierOne
 * @package AoC2017
 */
class CarrierOne
{
    /**
     * @var array
     */
    protected $grid;

    /**
     * @var array
     */
    protected $pos;

    /**
     * @var string
     */
    protected $dir;

    /**
     * @var int
     */
    protected $infectionCount = 0;

    /**
     * @var int
     */
    protected $bursts = 10000;

    /**
     * CarrierOne constructor.
     * @param array $grid
     */
    public function __construct(array $grid)
    {
        $this->grid = $grid;
        $this->pos = [0, 0];
        $this->dir = 'n';
    }

    /**
     *
     */
    public function burst(): void
    {
        if ($this->isInfected()) {
            $this->turnRight();
            $this->clean();
        } else {
            $this->turnLeft();
            $this->infect();
        }
        $this->move();
    }

    /**
     * @return int
     */
    public function getInfectionCount(): int
    {
        return $this->infectionCount;
    }

    /**
     * @return string
     */
    public function print(): string
    {
        $result = '';
        foreach ($this->grid as $line) {
            $result .= implode($line) . PHP_EOL;
        }
        return $result;
    }

    /**
     * @return int
     */
    public function getBursts(): int
    {
        return $this->bursts;
    }

    /**
     *
     */
    protected function move(): void
    {
        switch ($this->dir) {
            case 'n':
                $this->pos = [$this->pos[0] - 1, $this->pos[1]];
                break;
            case 'e':
                $this->pos = [$this->pos[0], $this->pos[1] + 1];
                break;
            case 's':
                $this->pos = [$this->pos[0] + 1, $this->pos[1]];
                break;
            case 'w':
                $this->pos = [$this->pos[0], $this->pos[1] - 1];
                break;
        }
    }

    /**
     * @return bool
     */
    protected function isInfected(): bool
    {
        $this->initEmptyField();
        return $this->getCurrentField() === '#';
    }

    /**
     *
     */
    protected function infect(): void
    {
        ++$this->infectionCount;
        $this->grid[$this->pos[0]][$this->pos[1]] = '#';
    }

    /**
     *
     */
    protected function clean(): void
    {
        $this->grid[$this->pos[0]][$this->pos[1]] = '.';
    }

    /**
     *
     */
    protected function turnRight(): void
    {
        switch ($this->dir) {
            case 'n':
                $this->dir = 'e';
                break;
            case 'e':
                $this->dir = 's';
                break;
            case 's':
                $this->dir = 'w';
                break;
            case 'w':
                $this->dir = 'n';
                break;
        }
    }

    /**
     *
     */
    protected function turnLeft(): void
    {
        switch ($this->dir) {
            case 'n':
                $this->dir = 'w';
                break;
            case 'e':
                $this->dir = 'n';
                break;
            case 's':
                $this->dir = 'e';
                break;
            case 'w':
                $this->dir = 's';
                break;
        }
    }

    /**
     *
     */
    protected function initEmptyField(): void
    {
        if (!array_key_exists($this->pos[0], $this->grid)
            || !array_key_exists($this->pos[1], $this->grid[$this->pos[0]])
        ) {
            $this->clean();
        }
    }

    /**
     * @return string
     */
    protected function getCurrentField(): string
    {
        return $this->grid[$this->pos[0]][$this->pos[1]];
    }
}

/**
 * Class CarrierTwo
 * @package AoC2017
 */
class CarrierTwo extends CarrierOne
{
    /**
     * CarrierTwo constructor.
     * @param array $grid
     */
    public function __construct(array $grid)
    {
        parent::__construct($grid);
        $this->bursts = 10000000;
    }

    /**
     *
     */
    public function burst(): void
    {
        if ($this->isInfected()) {
            $this->turnRight();
            $this->flag();
        } elseif ($this->isFlagged()) {
            $this->turnAround();
            $this->clean();
        } elseif ($this->isWeakened()) {
            $this->infect();
        } else { // clean
            $this->turnLeft();
            $this->weaken();
        }
        $this->move();
    }

    /**
     *
     */
    protected function flag(): void
    {
        $this->grid[$this->pos[0]][$this->pos[1]] = 'F';
    }

    /**
     *
     */
    protected function weaken(): void
    {
        $this->grid[$this->pos[0]][$this->pos[1]] = 'W';
    }

    /**
     * @return bool
     */
    protected function isFlagged(): bool
    {
        $this->initEmptyField();
        return $this->getCurrentField() === 'F';
    }

    /**
     * @return bool
     */
    protected function isWeakened(): bool
    {
        $this->initEmptyField();
        return $this->getCurrentField() === 'W';
    }

    /**
     *
     */
    protected function turnAround(): void
    {
        switch ($this->dir) {
            case 'n':
                $this->dir = 's';
                break;
            case 'e':
                $this->dir = 'w';
                break;
            case 's':
                $this->dir = 'n';
                break;
            case 'w':
                $this->dir = 'e';
                break;
        }
    }
}

/**
 * Class Day22
 * @package AoC2017
 */
class Day22 implements DayInterface
{
    /**
     * @var int
     */
    public $bursts;

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $grid = $this->getGrid($input);
        return $this->run(new CarrierOne($grid));
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $grid = $this->getGrid($input);
        return $this->run(new CarrierTwo($grid));
    }

    /**
     * @param $carrier
     * @return mixed
     */
    protected function run(CarrierOne $carrier)
    {
        $bursts = $this->bursts ?? $carrier->getBursts();
        for ($i = 1; $i <= $bursts; $i++) {
            $carrier->burst();
        }
        return $carrier->getInfectionCount();
    }

    /**
     * @param string $input
     * @return array
     */
    private function getGrid(string $input): array
    {
        $input = trim($input);
        $lines = explode(PHP_EOL, $input);
        $i = floor(\count($lines) / 2) * -1;
        $grid = [];
        foreach ($lines as $line) {
            $fields = str_split($line);
            $j = floor(\count($fields) / 2) * -1;
            foreach ($fields as $field) {
                $grid[$i][$j] = $field;
                $j++;
            }
            $i++;
        }
        return $grid;
    }
}
