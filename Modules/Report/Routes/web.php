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

Route::prefix('report')->group(function () {
    Route::get('/', 'ReportController@index');
    Route::prefix('nps')->group(function () {
        Route::get('/', 'NetPromoterScoreController@index');
        Route::get('/users/{score}', 'NetPromoterScoreController@score');
        Route::get('/user/{id}', 'NetPromoterScoreController@getScoreHistory');
    });
});
