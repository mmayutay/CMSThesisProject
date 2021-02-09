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

Route::get('list', 'Controls@list');

Route::get('allAccounts', 'Controls@allAccount');

Route::post('login', 'authController@login');

Route::post('/sign-up', 'authController@signUp');

Route::post('userProfile', 'App\Http\Controllers\Controls@getUserInfo');


//This is for the logged users matter
Route::post('/info','UserDisplayController@getUsers');

Route::post('getCurrentUser', 'App\Http\Controllers\LoggedUserMatters@getTheCurrentUser');

Route::get('edit', 'UserDisplayController@edit');

Route::post('updateUser', 'UserDisplayController@update');

Route::post('cell', 'Controls@getLeader');

Route::post('network', 'Controls@getnetwork');

Route::post('userId', 'Controls@getId');

Route::get('users', 'Controls@cell');

Route::get('day', 'Controls@getDay');


// Auth::routes();
