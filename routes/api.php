<?php

use Illuminate\Http\Request;
use Dingo\Api\Facade\API;
use Dingo\Api\Facade\Route;;
$api = app('Dingo\Api\Routing\Router');
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

$api->version('v1', function ($api) {
    $api->group(['middleware' => 'cors'], function ($api) {        
        $api->resource('images', 'App\Http\Controllers\ImagesApiController');
    });
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
