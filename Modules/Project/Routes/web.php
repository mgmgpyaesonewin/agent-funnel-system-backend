<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {

Route::prefix('project')->group(function() {    
    Route::get('/', 'ProjectController@index');
    Route::get('/promo', 'ProjectController@promo');
    Route::get('/promo/create', 'ProjectController@promo_create');
    Route::post('/promo/store', 'ProjectController@promo_store');
    Route::post('/promo/pause/{id}', 'ProjectController@promo_pause');
    Route::post('/promo/destroy/{id}', 'ProjectController@promo_destroy');
});
});