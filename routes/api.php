<?php

use App\Http\Controllers\Rest\RestController;
use Illuminate\Http\Request;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\Rest\AuthController@login')->name('auth.login');
    Route::get('books', [RestController::class, 'index']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::post('login', [RestController::class, 'authenticate']);
//Route::post('register', [RestController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [RestController::class, 'logout']);
    Route::get('get_user', [RestController::class, 'get_user']);

});



//Route::get('books', [RestController::class, 'index']);
//Route::get('books/{book}', [RestController::class, 'show']);
//
//Route::post('books', [RestController::class, 'create']);
//
//Route::put('books/{book}', [RestController::class, 'update']);
//Route::delete('books/{book}', [RestController::class, 'delete']);




