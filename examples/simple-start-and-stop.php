<?php

include('../src/Stopwatch.php');

$counter = 10;
Stopwatch::start();
for($i = 0; $i < $counter; $i++) {
    sleep(1);
}
$time = Stopwatch::stop();

echo "A foreach of {$counter} loops took approximately {$time} seconds\n";

die;