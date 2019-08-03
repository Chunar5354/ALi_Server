<?php

require __DIR__.'/../vendor/autoload.php';

use Predis\Client;

$client = new Client('tcp://127.0.0.1:6379');

$key = 'ts:raspberrypi:U';
$min = 1560047583;
$max = $min + 1;

$raw_data = $client->zrangebyscore($key, $min, $max, ['withscores' => true]);

        $pre_data = [];
$combs = array_keys($raw_data);

        foreach ($combs as $comb) {
            $comb = explode(':', $comb);
            $pre_time = explode('.', $comb[1]);
            $key = date('Y-m-d H:i:s', (int)$pre_time[0]).'.'.$pre_time[1];
            $pre_data[$key] = $comb[0];
        }

        $data = json_encode($pre_data);

print_r($data);
