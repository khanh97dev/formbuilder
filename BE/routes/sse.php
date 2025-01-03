<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('sse/{uuid}', function ($uuid) {
    $validate = Validator::make(data: [
        'uuid' => $uuid,
    ], rules: [
        'uuid' => 'uuid'
    ]);

    if ($validate->fails()) {
        return response($validate->errors(), 400);
    }

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    echo 'data: ' . json_encode([
        'message' => 'Hello, SSE!',
        'timestamp' => time(),
        'uuid' => $uuid
    ]);
    echo PHP_EOL . PHP_EOL;
    ob_flush();
    flush();
});
