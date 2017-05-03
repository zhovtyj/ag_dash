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
        'client_id' => 'AfZlwLFHJiePviAW4moFZJ49iGMvDesVwVkgls_DQ-Uq99M-_0_NWr56Un1u3zV3TrU0S33E_xcXT2J_',
        //'secret' => 'EIhWTArEXVRC3DZFJRwr6GRea8OTllfLydhdeX5OZhVOEXgQNDWVmvxOCX1qbWJoBt7r0KeDWpB38y1e'
        'secret' => 'EJA06syBYiuWtbsj36ICxmg0J5kJfxBW3eRgLz_k3Tn0RplKDyzyX3cD3GJkXJ5AQt4_-AIr7C_s3wWI'
    ],

];
