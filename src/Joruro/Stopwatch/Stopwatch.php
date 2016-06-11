<?php

namespace Joruro\Stopwatch;

use Joruro\Enum\TimeUnits;

/**
 * Class Stopwatch
 */
class Stopwatch
{

    private static $instance;

    /** @var string $timeUnits */
    private $timeUnit;

    private function __construct() {}

    /** @var array $startSlots */
    private $startSlots = [];

    /**
     * Configures the stopwatch
     * @param $config
     */
    public static function configure($config)
    {
        $instance = self::stopwatch();
        if(empty($config)) {
            return;
        }
        if(isset($config['timeUnit'])) {
            $instance->timeUnit = $config['timeUnit'];
        }

        self::stopwatch()->push(microtime(true));
    }

    /**
     * Starts the stopwatch
     */
    public static function start()
    {
        self::stopwatch()->push(microtime(true));
    }

    /**
     * Stops the stopwatch
     * @param null $timeUnit
     * @return float
     */
    public static function stop($timeUnit = null)
    {
        $startTime = self::stopwatch()->pop();

        $totalTime = microtime(true) - $startTime;

        return self::stopwatch()->timeConverter($totalTime, $timeUnit);
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

    /**
     * @param float $time
     * @param null|string $timeUnit
     * @return float
     */
    private function timeConverter($time, $timeUnit = null)
    {
        return $time * $this->unitMapper($timeUnit);
    }

    /**
     * @param string|null $timeUnit
     * @return int
     * @throws InvalidTimeUnitException
     */
    private function unitMapper($timeUnit)
    {
        $timeUnit = ($timeUnit)?: $this->timeUnit;

        switch($timeUnit) {
            case TimeUnits::SECONDS: return 1;
            case TimeUnits::MILLISECONDS: return 1000;
            case TimeUnits::MICROSECONDS: return 1000000;
        }

        throw new InvalidTimeUnitException($timeUnit);
    }

}