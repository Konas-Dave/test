<?php


namespace App\Tools;


use App\Interfaces\ILogger;

/**
 * Class FileLogger
 * @package App\Tools
 */
class FileLogger implements ILogger
{

    function log($value, $priority = self::INFO)
    {
        $dir = 'log';
        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
        $logFile = $dir."/$priority.log";
        file_put_contents($logFile, date('Y-m-d H:i:s') . ': ' . print_r($value, true) . "\n", FILE_APPEND);
    }
}