<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')->group(function () {


    //Auth Rotes

    include __DIR__ . '\v1\auth_routes.php';

    // Channel ROUTES
    include __DIR__ . '\v1\channels_routes.php';

    // Thread ROUTES
    include __DIR__ . '\v1\threads_routes.php';

});
