<?php

return [
    'url'             => env('PAYME_URL'),
    'url_script'      => env('PAYME_URL_SCRIPT'),
    'url_modal'      => env('PAYME_URL_MODAL'),
    'acquirer_id'     => env('PAYME_ACQUIRER_ID'),
    'commerce_id'     => env('PAYME_COMMERCE_ID'),
    'commerce_secret' => env('PAYME_COMMERCE_SECRET'),
    'currency_code'   => env('PAYME_CURRENCY_CODE'),

    'authorizationResult' =>['00'=>'Operación Autorizada', '01'=>'Operación Denegada', '05'=>'Operación Denegada'],

    'errorCode' =>['00'=>'Operación Autorizada', '01'=>'Operación Denegada', '05'=>'Operación Denegada'],

];