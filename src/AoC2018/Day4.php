<?php

namespace AoC2018;

/**
 * Class Day4
 * @package AoC2018
 */
class Day4 implements DayInterface
{
    /**
     *
     */
    private const SLEEP = 'falls';

    /**
     *
     */
    private const AWAKE = 'wakes';

    /**
     * @param string $input
     * @return int
     */
    public function solveFirst(string $input): int
    {
        $input = trim($input);
        $records = $this->getSortedRecords($input);
        $guardsSleep = [];
        foreach ($records as $record) {
            if ($record['event'] === self::SLEEP) {
                $sleepTime = $record['time'];
            }
            if ($record['event'] === self::AWAKE) {
                /** @var \DateTimeImmutable $wakeTime */
                $wakeTime = $record['time'];
                if (!array_key_exists($record['guard'], $guardsSleep)) {
                    $guardsSleep[$record['guard']] = 0;
                }
                $guardsSleep[$record['guard']] += (int)$wakeTime->diff($sleepTime)->format('%i');
            }
        }
        arsort($guardsSleep);
        reset($guardsSleep);
        $guard = key($guardsSleep);
        $minutes = [];
        foreach ($records as $record) {
            if ((int)$record['guard'] !== $guard) {
                continue;
            }
            if ($record['event'] === self::SLEEP) {
                $sleepTime = $record['time'];
            }
            if ($record['event'] === self::AWAKE) {
                /** @var \DateTimeImmutable $wakeTime */
                $wakeTime = $record['time'];
                foreach (range($sleepTime->format('i'), $wakeTime->format('i') - 1) as $min) {
                    $minutes[] = $min;
                }
            }
        }
        $values = array_count_values($minutes);
        arsort($values);
        reset($values);
        $most = key($values);
        return $guard * $most;
    }

    /**
     * @param string $input
     * @return int
     */
    public function solveSecond(string $input): int
    {
        $input = trim($input);
        $records = $this->getSortedRecords($input);
        $minutes = [];
        foreach ($records as $record) {
            if (!array_key_exists($record['guard'], $minutes)) {
                $minutes[$record['guard']] = [];
            }
            if ($record['event'] === self::SLEEP) {
                /** @var \DateTimeImmutable $sleepTime */
                $sleepTime = $record['time'];
            }
            if ($record['event'] === self::AWAKE) {
                /** @var \DateTimeImmutable $wakeTime */
                $wakeTime = $record['time'];
                foreach (range((int)$sleepTime->format('i'), (int)$wakeTime->format('i') - 1) as $min) {
                    $minutes[$record['guard']][] = $min;
                }
            }
        }
        $mostGuard = [];
        foreach ($minutes as $guard => $minute) {
            $values = array_count_values($minute);
            arsort($values);
            reset($values);
            $mostGuard[$guard] = [key($values) => array_shift($values)];
        }
        $keep = 0;
        $sleepyGuard = 0;
        foreach ($mostGuard as $guard => $freq) {
            if (current($freq) > $keep) {
                $keep = current($freq);
                $sleepyGuard = $guard;
                $sleepyMinute = key($freq);
            }
        }
        return $sleepyGuard * $sleepyMinute;
    }

    /**
     * @param string $input
     * @return array
     */
    private function getSortedRecords(string $input): array
    {
        $records = [];
        foreach (explode(PHP_EOL, $input) as $line) {
            $event = null;
            $guard = null;
            preg_match_all('/\d+/', $line, $matches);
            $m = $matches[0];
            [$year, $month, $day, $hour, $minute] = $m;
            if (\count($m) === 6) {
                $guard = $m[5];
            }
            foreach (['begins', self::SLEEP, self::AWAKE] as $needle) {
                if (strpos($line, $needle) !== false) {
                    $event = $needle;
                    break;
                }
            }
            $records[] = [
                'time' => \DateTimeImmutable::createFromFormat('Y-m-d H:i',
                    sprintf('%s-%s-%s %s:%s', $year, $month, $day, $hour, $minute)),
                'guard' => $guard,
                'event' => $event,
            ];
        }
        usort($records, function ($a, $b) {
            return $a['time'] <=> $b['time'];
        });
        foreach ($records as &$record) {
            if ($record['guard'] !== null) {
                $guard = $record['guard'];
            } else {
                $record['guard'] = $guard;
            }
        }
        return $records;
    }
}
