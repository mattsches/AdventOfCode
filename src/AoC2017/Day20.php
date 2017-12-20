<?php

namespace AoC2017;

/**
 * Class Particle
 * @package AoC2017
 */
class Particle
{
    /**
     * @var array
     */
    private $position;

    /**
     * @var array
     */
    private $velocity;

    /**
     * @var array
     */
    private $acceleration;

    /**
     * Particle constructor.
     * @param array $position
     * @param array $velocity
     * @param array $acceleration
     */
    public function __construct(array $position, array $velocity, array $acceleration)
    {
        $this->position = [
            'x' => $position[0],
            'y' => $position[1],
            'z' => $position[2],
        ];
        $this->velocity = [
            'x' => $velocity[0],
            'y' => $velocity[1],
            'z' => $velocity[2],
        ];
        $this->acceleration = [
            'x' => $acceleration[0],
            'y' => $acceleration[1],
            'z' => $acceleration[2],
        ];
    }

    /**
     * Updates the position by applying acceleration and velocity changes
     */
    public function updatePosition(): void
    {
        $this->velocity['x'] += $this->acceleration['x'];
        $this->velocity['y'] += $this->acceleration['y'];
        $this->velocity['z'] += $this->acceleration['z'];
        $this->position['x'] += $this->velocity['x'];
        $this->position['y'] += $this->velocity['y'];
        $this->position['z'] += $this->velocity['z'];
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return array_reduce($this->position, function ($distance, $value) {
            $distance += abs($value);
            return $distance;
        });
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->position['x'] . '|' . $this->position['y'] . '|' . $this->position['z'];
    }
}

/**
 * Class Day20
 * @package AoC2017
 */
class Day20 implements DayInterface
{
    /**
     * @param string $input
     * @return string
     */
    public function solveFirst(string $input): string
    {
        $particles = [];
        $distances = [];
        foreach (explode(PHP_EOL, trim($input)) as $id => $buffer) {
            $coordinates = array_map(function ($coordinate) {
                $coordinate = preg_replace('/[^\d-,]/', '', $coordinate);
                return explode(',', $coordinate);
            }, explode(', ', $buffer));
            $particle = new Particle($coordinates[0], $coordinates[1], $coordinates[2]);
            $particles[$id] = $particle;
            $distances[$id] = $particle->getDistance();
        }
        $minParticleId = [];
        $threshold = 1000;
        while (true) {
            $distances = [];
            /** @var Particle $particle */
            foreach ($particles as $id => $particle) {
                $particle->updatePosition();
                $distances[$id] = $particle->getDistance();
            }
            $minDistanceCount = array_keys($distances, min($distances), true);
            if (\count($minDistanceCount) === 1) {
                $minParticleId[] = $minDistanceCount[0];
            }
            if (\count($minParticleId) > $threshold) {
                $last = \array_slice($minParticleId, -1 * $threshold, $threshold, true);
                if (\count(array_unique($last)) === 1) {
                    break;
                }
            }
        }
        return array_shift($last);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $particles = [];
        foreach (explode(PHP_EOL, trim($input)) as $id => $buffer) {
            $coordinates = array_map(function ($coordinate) {
                $coordinate = preg_replace('/[^\d-,]/', '', $coordinate);
                return explode(',', $coordinate);
            }, explode(', ', $buffer));
            $particle = new Particle($coordinates[0], $coordinates[1], $coordinates[2]);
            $particles[$id] = $particle;
        }
        $unchanged = 0;
        while ($unchanged < 1000) {
            $positions = [];
            /** @var Particle $particle */
            foreach ($particles as $id => $particle) {
                $particle->updatePosition();
                $positions[$id] = $particle->toString();
            }
            $uniquePositions = array_count_values($positions);
            if (\count($uniquePositions) !== \count($positions)) {
                foreach ($uniquePositions as $key => $count) {
                    if ($count > 1) {
                        $removeKeys = array_keys($positions, $key);
                        foreach ($removeKeys as $removeKey) {
                            unset($particles[$removeKey]);
                        }
                    }
                }
            } else {
                $unchanged++;
            }
        }
        return \count($particles);
    }
}
