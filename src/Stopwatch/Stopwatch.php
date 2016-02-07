<?php

namespace Stopwatch;

/**
 * Class Stopwatch
 */
class Stopwatch
{

    private static $instance;

    private function __construct() {}

    /** @var array $startSlots */
    private $startSlots = [];

    /**
     * Starts the stopwatch
     */
    public static function start()
    {
        self::stopwatch()->push(microtime(true));
    }

    /**
     * Stops the stopwatch
     * @return int $total
     */
    public static function stop()
    {
        $startTime = self::stopwatch()->pop();
        $total = round((microtime(true) - $startTime),6);

        return $total;
    }

    /**
     * @return self
     */
    private static function stopwatch() {
        if(null === static::$instance) {
            static::$instance = new Stopwatch();
        }
        return static::$instance;
    }

    /**
     * @return array
     */
    private function startSlots()
    {
        return $this->startSlots;
    }

    private function pop()
    {
        $slots = $this->startSlots();
        $v = array_pop($slots);
        $this->setStartSlots($slots);
        return $v;
    }

    private function push($time)
    {
        $slots = $this->startSlots();
        array_push($slots,$time);
        $this->setStartSlots($slots);
    }

    private function setStartSlots($slots)
    {
        $this->startSlots = $slots;
    }

}