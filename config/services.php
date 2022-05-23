<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '3089833894603789',
        'client_secret' => '4a9eaff6c688beaaccf5768ecf58731d',
        'redirect' => 'http://127.0.0.1:8000/auth/facebook/callback',
    ],

    
    'github' => [
        'client_id' => 'eed85fa5296a6dddeeee',
        'client_secret' => '16b60de1d44f7a32c8ad650927ef22edccf305c3',
        'redirect' => 'http://127.0.0.1:8000/auth/github/callback',
    ],
];
