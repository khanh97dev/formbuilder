<?php

use Illuminate\Support\Facades\Route;

include_once __DIR__ . '/sse.php';
include_once __DIR__ . '/filemanager.php';

Route::get('/', function () {
    return view('welcome');
});
