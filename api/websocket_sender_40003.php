<?php

set_time_limit(0);

require __DIR__ . '/../vendor/autoload.php';

use Workerman\Worker;
use Moech\Data\Raspi\RaspiDataConvey;

$ws_worker = new Worker('websocket://172.17.52.39:40003');

$ws_worker->count = 4;

$ws_worker->onConnect = static function ($connection)
{
    $connection->onMessage = static function ($connection, $data)
    {
        $run = new RaspiDataConvey();
		
        $connection->send($run->fetchData($data));
    };
};

Worker::runAll();
