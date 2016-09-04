<?php

namespace Joruro\Stopwatch;

class InvalidTimeUnitException extends \Exception
{
    /**
     * @var string
     */
    protected $timeUnit;

    /**
     * Constructor.
     *
     * @param string     $timeUnit
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($timeUnit, $code = 0, \Exception $previous = null)
    {
        $this->timeUnit = $timeUnit;

        parent::__construct("The time unit {$timeUnit} is invalid", $code, $previous);
    }

    /**
     * Get the path which was not found.
     *
     * @return string
     */
    public function getTimeUnit()
    {
        return $this->timeUnit;
    }
}
