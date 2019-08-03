<?php

set_time_limit(0);

require __DIR__ . '/../vendor/autoload.php';

use Workerman\Worker;
use Moech\Data\Raspi\RaspiDataConvey;

$ws_worker = new Worker('tcp://172.17.52.39:40002');

$ws_worker->count = 4;

$ws_worker->onConnect = static function ($connection)
{
    $connection->onMessage = static function ($connection, $data)
    {
        $run = new RaspiDataConvey();
        $connection->send($run->fetchData($data) . "\n");
    };
};

Worker::runAll();
