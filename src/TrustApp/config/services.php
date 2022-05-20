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

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('pk_test_51GrrIyKCyJL0Snmtmtr0fyFvz4D0RMvKzxwMaT3sPILazJfwHhFn198qTLI1S9039jWZDND4vi8aedD0k8jKqDjN00Yp4LIxnk'),
        'secret' => env('sk_test_51GrrIyKCyJL0SnmtUPl67iH7JqMOs7oHHlINOMYSE1ItdYJ7Z58t9phRwNVNo23Z1SSQiD1XI3B4IZBE1RXi8gI700XAgwNU2S'),
    ],

];
