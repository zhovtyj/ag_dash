<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        //SandBox Settings
        //'client_id' => 'AbjdhLbkomdbqSSNPA0ZD4wLqmEUkGWbRUNu4t1ShpVKsIWtkNGNJR6LJDEw90o5MEFEUR6GD3macWYK',
        'client_id' => 'AbjdhLbkomdbqSSNPA0ZD4wLqmEUkGWbRUNu4t1ShpVKsIWtkNGNJR6LJDEw90o5MEFEUR6GD3macWYK',
        //'secret' => 'EIhWTArEXVRC3DZFJRwr6GRea8OTllfLydhdeX5OZhVOEXgQNDWVmvxOCX1qbWJoBt7r0KeDWpB38y1e'
        'secret' => 'access_token$production$v6kfsymnqb3ycsc6$3b45aec81dce2952f3fe0b94cacac17a'
    ],

];
