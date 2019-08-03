<?php

set_time_limit(0);

require __DIR__ . '/../vendor/autoload.php';

use Workerman\Worker;
use Moech\Data\Raspi\RaspiDataConvey;

$ws_worker = new Worker('tcp://172.17.52.39:30001');

$ws_worker->count = 4;

$ws_worker->onConnect = static function ($connection)
{
    $connection->onMessage = static function ($connection, $data)
    {
        $data = json_decode($data, true);

        $testRun = new RaspiDataConvey();

        $queries = $testRun->queryGlueParody($data);
        // MariaDB queries
        $testRun->goInReDB($queries['ReDB']);
        // Redis queries
        $testRun->goInNoDB($queries['NoDB']);
    };
};

Worker::runAll();
