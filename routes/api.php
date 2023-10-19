<?php

use Illuminate\Http\Request;

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

Route::get('/get-all-queue', "GetAllQueueController@getAll")->name("get-all-queue");

Route::get('/send-dummy-email', "SendDummyEmailController@sendEmail")->name("send-email");
Route::get('/spam-dummy-email', "SendDummyEmailController@spamEmail")->name("spam-email");

Route::post('/login', "TestPassportAuthController@login")->name("login");
Route::middleware('auth:api')->get('/logout', "TestPassportAuthController@logout")->name("logout");

Route::post('/create-user', "TestPassportAuthController@store")->name("create-user");
Route::middleware('auth:api')->get('/show-user/{id}', "TestPassportAuthController@show")->name("show-user");


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
