<?php

include('../src/Stopwatch/Stopwatch.php');

$counter = 10;
\Stopwatch\Stopwatch::start();
for($i = 0; $i < $counter; $i++) {
    sleep(1);
}
$time = \Stopwatch\Stopwatch::stop();

echo "A foreach of {$counter} loops took approximately {$time} seconds\n";

die;