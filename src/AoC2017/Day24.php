<?php

namespace AoC2017;

/**
 * Class Component
 * @package AoC2017
 */
class Component
{
    /**
     * @var array
     */
    private $ports;

    /**
     * @var bool
     */
    private $inUse = false;

    /**
     * Component constructor.
     * @param array $ports
     */
    public function __construct(array $ports)
    {
        $this->ports = $ports;
    }

    /**
     * Use component in bridge
     */
    public function use(): void
    {
        $this->inUse = true;
    }

    /**
     * @return bool
     */
    public function isInUse(): bool
    {
        return $this->inUse;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return array_sum($this->ports);
    }

    /**
     * @param $port
     * @return int|null
     */
    public function getOppositePort($port): ?int
    {
        switch ($port) {
            case $this->ports[0]:
                return $this->ports[1];
                break;
            case $this->ports[1]:
                return $this->ports[0];
                break;
            default:
                return null;
        }
    }

    /**
     * Release component from use
     */
    public function release(): void
    {
        $this->inUse = false;
    }
}

/**
 * Class Day24
 * @package AoC2017
 */
class Day24 implements DayInterface
{
    /**
     * @var array
     */
    private $components;

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $this->components = [];
        $allPorts = array_map(function ($c) {
            return array_map('\intval', explode('/', $c));
        }, explode(PHP_EOL, trim($input)));
        foreach ($allPorts as $ports) {
            $component = new Component($ports);
            $this->components[$ports[0]][] = $component;
            $this->components[$ports[1]][] = $component;
        }
        return $this->buildStrongestBridge(0);
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $this->components = [];
        $allPorts = array_map(function ($c) {
            return array_map('\intval', explode('/', $c));
        }, explode(PHP_EOL, trim($input)));
        foreach ($allPorts as $ports) {
            $component = new Component($ports);
            $this->components[$ports[0]][] = $component;
            $this->components[$ports[1]][] = $component;
        }
        return $this->buildLongestBridge(0)[1];
    }

    /**
     * @param $port
     * @return int
     */
    private function buildStrongestBridge($port): int
    {
        $strength = 0;
        if (!array_key_exists($port, $this->components)) {
            return $strength;
        }
        /** @var Component $component */
        foreach ($this->components[$port] as $component) {
            if ($component->isInUse()) {
                continue;
            }
            $component->use();
            $strength = max(
                $strength,
                $component->getStrength() + $this->buildStrongestBridge($component->getOppositePort($port))
            );
            $component->release();
        }
        return $strength;
    }

    /**
     * @param $port
     * @return array
     */
    private function buildLongestBridge($port): array
    {
        $length = $strength = 0;
        if (!array_key_exists($port, $this->components)) {
            return [$length, $strength];
        }
        /** @var Component $component */
        foreach ($this->components[$port] as $component) {
            if ($component->isInUse()) {
                continue;
            }
            $component->use();
            $result = $this->buildLongestBridge($component->getOppositePort($port));
            ++$result[0];
            $result[1] += $component->getStrength();
            if ($result[0] > $length) {
                [$length, $strength] = $result;
            } elseif ($result[0] === $length) {
                $strength = max($strength, $result[1]);
            }
            $component->release();
        }
        return [$length, $strength];
    }
}
