<?php

spl_autoload_register( function($class_name ) {
    $file_name = $class_name . '.php';
    if( file_exists( $file_name ) ) {
        require $file_name;
    }
} );

// code here
use Tools\CzcGrabber;
use Tools\JsonGenerator;
use Tools\FileLogger;

$grabber = new CzcGrabber();
$output = new JsonGenerator();
$logger = new FileLogger();
$dispatcher = new Dispatcher($grabber, $output, $logger);
$dispatcher->run();

