<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

include_once __DIR__ . '/sse.php';
include_once __DIR__ . '/filemanager.php';

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sse', function () {
    return view('sse');
});
Route::post('/sse', function (Request $request) {
    return Cache::set('sse',[
        'uuid' => $request->input('uuid'),
        'text' => $request->input('text'),
        'timestamp' => $request->input('timestamp'),
    ]);
});
