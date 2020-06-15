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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd(auth('api')->user());

    return $request->user();
});

Route::group(['middleware' => 'auth'], function () {
    // Route url
    Route::get('/', 'DashboardController@dashboardAnalytics')->name('home');

    // Route Dashboards
    Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');

    // Route Components
    Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
    Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
    Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
    Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

    Route::get('/applicants', 'ApplicantController@applicants');
    Route::get('/applicants/{id}', 'ApplicantController@applicantsDetail');
});
