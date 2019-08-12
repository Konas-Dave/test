<?php
$container = require __DIR__ . '/app/bootstrap.php';

$container->getByType(Dispatcher::class)
    ->run();