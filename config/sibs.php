<?php

return [
    'mode' => 'test',
    'host' => env('SIBS_HOST', 'https://test.oppwa.com/'),
    'version' => 'v1',
    'authentication' => [
        'userId' => env('SIBS_AUTH_USERID', '8a8294185332bbe60153375476c31527'),
        'password' => env('SIBS_AUTH_PASSWORD', 'G5wP5TzF5k'),
        'entityId' => env('SIBS_AUTH_ENTITYID', '8a8294185332bbe601533754724914d9'),
        'token' => env('SIBS_AUTH_TOKEN', 'Bearer OGE4Mjk0MTg1MzMyYmJlNjAxNTMzNzU0NzZjMzE1Mjd8RzV3UDVUekY1aw=='),
    ],
    'entity' => env('SIBS_ENTITY', '21075'),

    /*
     * After completing your SIBS registration you will receive a key to decrypt its notifications via webhook.
     */
    'webHook' => env('SIBS_WEBHOOK_KEY', '')
];
