<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list', 'App\Http\Controllers\Controls@list');

Route::get('allAccounts', 'App\Http\Controllers\Controls@allAccount');

Route::post('login', 'App\Http\Controllers\authController@login');

Route::post('sign-up', 'App\Http\Controllers\authController@signUp');

Route::post('userProfile', 'App\Http\Controllers\Controls@getUserInfo');
