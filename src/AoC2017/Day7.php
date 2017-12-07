<?php

namespace AoC2017;

/**
 * Class Day7
 * @package AoC2017
 */
class Day7 implements DayInterface
{
    /**
     * @var array
     */
    private $tree = [];

    /**
     * @param string $input
     * @return string
     */
    public function solveFirst(string $input): string
    {
        $this->buildTree($input);
        $rootName = '';
        foreach ($this->tree as $rootName => $node) {
            if ($node['parent'] === null) {
                break;
            }
        }
        return $rootName;
    }

    /**
     * @param string $input
     */
    private function buildTree(string $input)
    {
        $input = trim($input);
        foreach (explode("\n", $input) as $program) {
            preg_match("/([a-z]+)\s+\((\d+)\)[^a-z]*([a-z, ]*)/i", $program, $matches);
            $this->tree[$matches[1]] = [
                'name' => $matches[1],
                'weight' => $matches[2],
                'children' => $matches[3] !== '' ? explode(', ', $matches[3]) : [],
                'parent' => null,
            ];
        }
        foreach ($this->tree as $idx => $node) {
            foreach ($node['children'] as $child) {
                $this->tree[$child]['parent'] = $idx;
            }
        }
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $this->buildTree($input);
        $requiredWeight = 0;
        foreach ($this->tree as $node) {
            try {
                $this->getChildrenWeight($node['children']);
            } catch (\UnexpectedValueException $e) {
                $requiredWeight = (int)$e->getMessage();
            }
        }
        return $requiredWeight;
    }

    /**
     * @param array $programNames
     * @return int
     * @throws \UnexpectedValueException
     */
    private function getChildrenWeight(array $programNames): int
    {
        if (\count($programNames) === 0) {
            return 0;
        }
        $weights = [];
        foreach ($programNames as $key => $name) {
            $weights[$name] = $this->tree[$name]['weight'] + $this->getChildrenWeight($this->tree[$name]['children']);
        }
        if (\count(array_unique($weights)) !== 1) {
            $wrongWeight = $rightWeight = null;
            foreach (array_count_values($weights) as $weight => $count) {
                if ($count === 1) {
                    $wrongWeight = $weight;
                } else {
                    $rightWeight = $weight;
                }
            }
            $index = array_search($wrongWeight, $weights, true);
            $result = $this->tree[$index]['weight'] - $wrongWeight + $rightWeight;
            throw new \UnexpectedValueException($result);
        }
        return array_sum($weights);
    }
}
