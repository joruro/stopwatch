# Stopwatch

Stopwatch is a very simple tool for measuring the execution time of multiple parts of your code.

## Example of usage
```php
<?php

use Joruro\Stopwatch\Stopwatch;

require __DIR__ . '/vendor/autoload.php';

$attempts = 2;
$counter = 5;

Stopwatch::start();
for($j = 0; $j < $attempts; $j++) {
    Stopwatch::start();
    for($i = 0; $i < $counter; $i++) {
        sleep(1);
    }
    $time = Stopwatch::stop();
    echo "A foreach of {$counter} loops took approximately {$time} seconds\n";
}
$time = Stopwatch::stop();
echo "{$attempts} attempts foreach of {$counter} loops took approximately {$time} seconds\n";
```
