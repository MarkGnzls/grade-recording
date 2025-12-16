<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This file must exist even if you are not using APIs.
| Laravel 11 requires it to prevent runtime errors.
|
*/

Route::middleware('api')->get('/ping', function () {
    return response()->json([
        'status' => 'ok'
    ]);
});
