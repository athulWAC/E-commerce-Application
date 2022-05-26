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
    'google' => [
        'client_id' => '512547327069-803fga5dalfs14s1lqbg7rdlm0eu609v.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/invoice-system/callback/google',
    ],
    'github' => [
        'client_id' => 'f0df2bf552f8cbb63412',
        'client_secret' => '90800d8810ccb1fc4944938c08054524fe536ff8',
        'redirect' => 'http://localhost/invoice-system/callback/github',
    ],




];
