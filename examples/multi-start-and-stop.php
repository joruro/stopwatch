<?php

include('../src/Stopwatch/Stopwatch.php');

$attempts = 2;
$counter = 5;
\Stopwatch\Stopwatch::start();
for($j = 0; $j < $attempts; $j++) {
    \Stopwatch\Stopwatch::start();
    for($i = 0; $i < $counter; $i++) {
        sleep(1);
    }
    $time = \Stopwatch\Stopwatch::stop();
    echo "A foreach of {$counter} loops took approximately {$time} seconds\n";
}
$time = \Stopwatch\Stopwatch::stop();
echo "{$attempts} attempts foreach of {$counter} loops took approximately {$time} seconds\n";

die;