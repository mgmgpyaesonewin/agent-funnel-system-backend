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

// use Illuminate\Routing\Route;

Auth::routes(['register' => false]);

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

    Route::get('/pre_filter', 'ApplicantController@preFilterPage');
    Route::get('/pru_dna_filter', 'ApplicantController@pruDNAFilter');

    Route::get('/screened', 'ApplicantController@screenedPage');
    Route::get('/invited', 'ApplicantController@invitedPage');
    Route::get('/onboarded', 'ApplicantController@onboardedPage');
    Route::get('/trainee', 'ApplicantController@traineePage');
    Route::get('/qualified', 'ApplicantController@qualifiedPage');

    Route::get('/applicants/{id}', 'ApplicantController@applicantsDetail');

    Route::resource('trainings', 'TrainingController');
    Route::resource('partners', 'PartnerController');
});

Route::get('/applicant/{type}/{id}', 'ApplicantController@setupWebinar');
