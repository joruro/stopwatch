<?php

namespace Joruro\Stopwatch;

use Joruro\Enum\TimeUnits;

/**
 * Class Stopwatch
 */
class Stopwatch
{

    /**
     * Stopwatch instance
     * @var self
     */
    private static $instance;

    /**
     * Time units type
     * @var string
     */
    private $timeUnit;

    /**
     * Protected construct for the Singleton pattern
     */
    protected function __construct()
    {

    }

    /** @var array $startSlots */
    private $startSlots = [];

    /**
     * Configures the stopwatch
     * @param $config
     */
    public static function configure($config)
    {
        $instance = self::stopwatch();
        if (empty($config)) {
            return;
        }
        if (isset($config['timeUnit'])) {
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
     * Returns the stopwatch instance. If it
     * does not exist, creates it first
     * @return self
     */
    protected static function stopwatch()
    {
        if (null === static::$instance) {
            static::$instance = new Stopwatch();
        }
        return static::$instance;
    }

    /**
     * Returns the array of reserved
     * @return array
     */
    protected function startSlots()
    {
        return $this->startSlots;
    }

    /**
     * Remove a reserved slot from the stack
     * @return float UNIX timestamp in microseconds
     */
    protected function pop()
    {
        $slots = $this->startSlots();
        $v = array_pop($slots);
        $this->setStartSlots($slots);
        return $v;
    }

    /**
     * Add a reserved slot to the stack
     * @param  float $time UNIX timestamp in microseconds
     * @return $this
     */
    protected function push($time)
    {
        $slots = $this->startSlots();
        array_push($slots, $time);
        $this->setStartSlots($slots);
        return $this;
    }

    /**
     * Set an array of reserved starting slots
     * @param array $slots
     * @return $this
     */
    protected function setStartSlots($slots)
    {
        $this->startSlots = $slots;
        return $this;
    }

    /**
     * @param float $time
     * @param null|string $timeUnit
     * @return float
     */
    protected function timeConverter($time, $timeUnit = null)
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

        switch ($timeUnit) {
            case TimeUnits::SECONDS:
                return 1;
            case TimeUnits::MILLISECONDS:
                return 1000;
            case TimeUnits::MICROSECONDS:
                return 1000000;
        }

        throw new InvalidTimeUnitException($timeUnit);
    }
}
