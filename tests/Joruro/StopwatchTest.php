<?php

namespace Joruro;

use Joruro\Enum\TimeUnits;
use Joruro\Stopwatch\Stopwatch;

class StopwatchTest extends \PHPUnit_Framework_TestCase
{
    public function test_5_milliseconds_and_print_seconds()
    {
        Stopwatch::start();

        // Sleep 0.005 second
        usleep(5000);

        $total = Stopwatch::stop(TimeUnits::SECONDS);

        $this->assertTrue($total > 0.005 && $total < 0.050);
    }

    public function test_configure_stopwatch_and_test_5_milliseconds_and_print_milliseconds()
    {
        Stopwatch::configure([
            'timeUnit' => TimeUnits::MILLISECONDS
        ]);

        Stopwatch::start();

        // Sleep 0.005 second
        usleep(5000);

        $total = Stopwatch::stop();

        $this->assertTrue($total > 5 && $total < 50);
    }
}
