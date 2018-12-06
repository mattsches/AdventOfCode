# Advent of Code 2018

## Day 5

First approach: A recursive method. Worked fine with the test data, but turned out to be a memory hog using the puzzle
input.

```php
/**
 * @param array $units
 * @return array
 */
private function react(array $units): array
{
    $b = '';
    foreach ($units as $key => $unit) {
        if (abs(ord($unit) - ord($b)) === 32) {
            unset($units[$key], $units[$key - 1]);
            return $this->react(array_values($foo));
        }
        $b = $unit;
    }
    return $units;
}
```

Okay, this can be optimized for memory usage:

```php
$units = str_split(trim($input));
while (true) {
    $b = '';
    $reset = false;
    foreach ($units as $key => $unit) {
        if (abs(ord($unit) - ord($b)) === 32) {
            unset($units[$key], $units[$key - 1]);
            $units = array_values($units);
            $reset = true;
            break;
        }
        $b = $unit;
    }
    if (!$reset) {
        break;
    }
}
return \count($units);
```

But still, it took almost two minutes (on my machine) to solve part 1, and almost an hour to solve part 2.

Found the correct solution, though, so move on for now and maybe optimize later (read of someone's solution in Elixir that 
finished in half a second!) ;)
