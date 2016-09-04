<?php

include('../vendor/autoload.php');

use Joruro\Enum\TimeUnits;
use Joruro\Stopwatch\Stopwatch;

$counter = 5;
$sleepTime = 1;
Stopwatch::start();
for ($i = 0; $i < $counter; $i++) {
    sleep($sleepTime);
}
$time = Stopwatch::stop(TimeUnits::SECONDS);

echo "A foreach of {$counter} loops where each loop slept {$sleepTime} seconds took approximately {$time} seconds\n";

exit(0);
