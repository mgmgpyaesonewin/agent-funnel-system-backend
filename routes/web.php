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
    Route::get('/pmli_filter', 'ApplicantController@pmliFilter');
    Route::get('/trainee', 'ApplicantController@traineePage');

    Route::get('/onboarded', 'ApplicantController@onboardedPage');
    Route::get('/certification', 'ApplicantController@certificationPage');
    Route::get('/contract', 'ApplicantController@contractPage');

    Route::get('/applicants/{id}', 'ApplicantController@applicantsDetail');

    Route::get('template/edit/{id}', 'TemplateFormController@edit');
    Route::post('template/activate/{id}', 'TemplateFormController@activate');
    Route::resource('templateforms', 'TemplateFormController');
    Route::resource('trainings', 'TrainingController');
    Route::resource('partners', 'PartnerController');
    Route::resource('payments', 'PaymentController');
    Route::get('/applicant/export/{id}', 'ExportController@applicantExport');
});

Route::get('/applicant/{type}/{id}', 'ApplicantController@setupWebinar');
