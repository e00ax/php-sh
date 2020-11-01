<?php

use Illuminate\Support\Str;

return [

    'app_name' => 'smarthome',
    'author' => 'ch.rickert',
    'version' => '0.1',
    'user' => '',
    'passwd' => '',

    /**
     * MySQL
     */
    'mysql' => [
        'server' => '',
        'username' => '',
        'passwd' => '',
        'db' => '',
    ],

    /**
     * Hue Lights
     */
    'hue' => [
        'bridgeip' => '',
        'userkey' => '',
        'defaultGroup' => 'Room',

        'slider' => [
            'bri' => 'start: 1; end: 254;',
            'hue' => 'start: 0; end: 65535;',
            'sat' => 'start: 0; end: 254;',
            'ct' => 'start: 153; end: 500;',
            'bri_inc' => 'start: -254; end: 254;',
            'sat_inc' => 'start: -254; end: 254;',
            'hue_inc' => 'start: -65534; end: 65534;',
            'ct_inc' => 'start: -65534; end: 65534;',
        ],

        // Allowed sensors
        'sensors' => [
            '1' => 'RWL021',
            '2' => 'ROM001',
        ],
    ],

    /**
     * Heater
     */
    'heater' => [
        'text' => '[smarthome => heater]',
        'ini' => '',
        'log' => '',
        'gpio' => '/usr/bin/gpio',
        'temp' => '21',
        'sleeptime' => '600',

        'mode' => [
            '1' => 'manual',
            '2' => 'auto',
            '3' => 'google',
        ],

        'channel' => [
            '1' => '26',
            '2' => '20',
            '3' => '21',
        ],

        'daemon' => [
            'path' => '',
            'name' => 'php-heater',
        ],

        'google' => [
            'token' => '',
            'credentials' => '',
            'id' => 'primary',
            'colorId' => '11',
            'maxResults' => '10',
        ],
    ],

    /**
     * Door manager
     */
    'door' => [
        'text' => '[smarthome => door manager]',
        'baseUrl' => '',
        'gpio' => '/usr/bin/gpio',
        'sleep' => '3',

        'channel' => [
            '1' => '26',
            'frontDoorBell' => '20',
            'frontDoor' => '21',
        ],
    ],


    /**
     * Nuki
     */
    'nuki' => [
        'bridgeIp' => '',
        'token' => '',
        'id' => '',
        'port' => ':8080',

        'lockStates' => [
            'uncalibrated' => '0',
            'locked' => '1',
            'unlocking' => '2',
            'unlocked' => '3',
            'locking' => '4',
            'unlatched' => '5',
            'unlocked (lock ‘n’ go)' => '6',
            'unlatching' => '7',
            'motor blocked' => '254',
            'undefined' => '255',
        ],

        'lockActions' => [
            'unlock' => '1',
            'lock' => '2',
            'unlatch' => '3',
            'lock ‘n’ go' => '4',
            'lock ‘n’ go with unlatch' => '5',
        ],
    ],

    /**
     * WS2801
     */
    'ws2801' => [
        'path' => '',
        'sleep' => '1000',
        'color' => '#e10000',
        'baseUrl' => '',

        'stripes' => [
            '1' => '',
            '2' => '',
        ],
    ],

    /**
     * Pagination
     */
    'pagination' => [
        'itemsPerPageTable' => '10',
        'itemsPerPageCanvasJs' => '1000',

        'optionsChart' => [
            '1' => '500',
            '2' => '1000',
            '3' => '10000',
        ],

        'optionsTable' => [
            '1' => '10',
            '2' => '50',
            '3' => '100',
            '4' => '500',
            '5' => '1000',
        ],
    ],

];
