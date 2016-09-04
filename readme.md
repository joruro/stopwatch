# Stopwatch

[![Latest Stable Version](https://poser.pugx.org/joruro/stopwatch/v/stable)](https://packagist.org/packages/joruro/stopwatch) [![Total Downloads](https://poser.pugx.org/joruro/stopwatch/downloads)](https://packagist.org/packages/joruro/stopwatch) [![Latest Unstable Version](https://poser.pugx.org/joruro/stopwatch/v/unstable)](https://packagist.org/packages/joruro/stopwatch) [![License](https://poser.pugx.org/joruro/stopwatch/license)](https://packagist.org/packages/joruro/stopwatch)

Stopwatch is a very simple tool for measuring the execution time of multiple parts of your code.

## Example of usage
```php
<?php

include('../vendor/autoload.php');

use Joruro\Enum\TimeUnits;
use Joruro\Stopwatch\Stopwatch;

$attempts = 2;
$counter = 5;
Stopwatch::start();
for ($j = 0; $j < $attempts; $j++) {
    Stopwatch::start();
    for ($i = 0; $i < $counter; $i++) {
        sleep(1);
    }
    $time = Stopwatch::stop(TimeUnits::SECONDS);
    echo "A foreach of {$counter} loops took approximately {$time} seconds\n";
}
$time = Stopwatch::stop(TimeUnits::SECONDS);
echo "{$attempts} attempts foreach of {$counter} loops took approximately {$time} seconds\n";

exit(0);
```
