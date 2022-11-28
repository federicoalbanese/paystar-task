<?php

return [
    'TERMINAL_ID' => env('IPG_TERMINAL_ID', 'xxx-xxx-xx'),
    'KEY' => env('IPG_KEY', 'hash'),
    'CALLBACK_URL' => env('IPG_CALLBACK_URL', 'http://localhost:8000/'),
    'CALLBACK_METHOD' => env('IPG_CALLBACK_METHOD', 'GET'),
];
