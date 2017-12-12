<?php

namespace AoC2017;

use SplQueue;

/**
 * Class Day12
 * @package AoC2017
 */
class Day12 implements DayInterface
{
    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $graph = $this->convertInputToGraph($input);
        $visited = $this->getVisitedNodes(0, $graph);
        return \count($visited);
    }

    /**
     * @param string $input
     * @return string
     */
    public function solveSecond(string $input): string
    {
        $graph = $this->convertInputToGraph($input);
        $groups = [];
        foreach (array_keys($graph) as $rootNode) {
            $visited = $this->getVisitedNodes($rootNode, $graph);
            sort($visited);
            $groups[] = $visited;
        }
        $unique = array_unique($groups, SORT_REGULAR);
        return \count($unique);
    }

    /**
     * @param string $input
     * @return array
     */
    private function convertInputToGraph(string $input): array
    {
        $input = trim($input);
        $graph = [];
        foreach (explode("\n", $input) as $line) {
            $nodes = explode(' <-> ', $line);
            $neighbouringNodes = explode(', ', $nodes[1]);
            $graph[$nodes[0]] = array_map(function ($v) {
                return (int)$v;
            }, $neighbouringNodes);
        }
        return $graph;
    }

    /**
     * Breadth first search
     * (shamelessly copied from https://github.com/lextoumbourou/bfs-php)
     *
     * @param $rootNode
     * @param $graph
     * @return array
     */
    private function getVisitedNodes($rootNode, $graph): array
    {
        $queue = new SplQueue();
        $queue->enqueue($rootNode);
        $visited = [$rootNode];
        while ($queue->count() > 0) {
            $node = $queue->dequeue();
            /** @var array $neighbours */
            $neighbours = $graph[$node];
            foreach ($neighbours as $neighbour) {
                if (!\in_array($neighbour, $visited, true)) {
                    $visited[] = $neighbour;
                    $queue->enqueue($neighbour);
                }
            }
        }
        return $visited;
    }
}
