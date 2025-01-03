<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'filemanager',
    'middleware' => [
        'web'
    ]
], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
