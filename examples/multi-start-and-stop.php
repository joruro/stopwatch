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
