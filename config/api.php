<?php 

/*
    |--------------------------------------------------------------------------
    | Config FILE FOR APIS
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

$config = array(
    'PAYPAL_CLIENT_ID' => env('PAYPAL_CLIENT_ID')
);

return $config;