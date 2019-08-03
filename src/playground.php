<?php

require __DIR__ . '/../vendor/autoload.php';

use Moech\Data\Raspi\RaspiDataConvey;
use Predis\Client;

$client = new Client('tcp://127.0.0.1:6379');

print_r($client->zrangebyscore('ts:raspberrypi:U', 1560047583, 1560047585));
