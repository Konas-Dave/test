<?php


namespace App\Interfaces;

/**
 * Interface ILogger
 * @package App\Interfaces
 */
interface ILogger
{
    const
        DEBUG = 'debug',
        INFO = 'info',
        WARNING = 'warning',
        ERROR = 'error',
        EXCEPTION = 'exception',
        CRITICAL = 'critical';

    function log($value, $priority = self::INFO);
}