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
// Route::get('download_contract', 'ApplicantController@download_contract');
Auth::routes(['register' => false]);

Route::get('pdf', 'ExportController@pdf');

Route::group(['middleware' => 'auth'], function () {
    // Route url
    Route::get('/', 'DashboardController@dashboardAnalytics')->name('home');

    // Route Components
    Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
    Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
    Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
    Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

    // SY Starts
    Route::get('/lead', 'ApplicantController@leadPage');
    Route::get('/create_lead', 'ApplicantController@create_lead');
    Route::post('/save_lead', 'ApplicantController@store');

    // Setting Dashboards
    Route::get('/setting', 'SettingController@index');

    Route::post('/setting/update_setting', 'SettingController@update');

    Route::get('/setting/import_history', 'SettingController@history');

    Route::get('/setting/download_history/{id}', 'SettingController@download_history');

    Route::get('/setting/remove_viber_img/{id}', 'SettingController@remove_viber_img');

    Route::get('/training/export/{id}', 'TrainingController@export');

    Route::get('/api/user/get_bdm_list', 'UserController@get_bdm_list');
    // SY Ends

    Route::get('/pre_filter', 'ApplicantController@preFilterPage');
    Route::get('/pru_dna_filter', 'ApplicantController@pruDNAFilter');
    Route::get('/pmli_filter', 'ApplicantController@pmliFilter');
    Route::get('/trainee', 'ApplicantController@traineePage');

    Route::get('/onboarded', 'ApplicantController@onboardedPage');
    Route::get('/certification', 'ApplicantController@certificationPage');
    Route::get('/contract', 'ApplicantController@contractPage');

    Route::get('/applicants/{id}', 'ApplicantController@applicantsDetail');
    Route::get('/setting/applicants/export', 'ExportController@applicantsExport');
    Route::post('/setting/applicants/import', 'ExportController@applicantsImport');

    Route::get('template/edit/{id}', 'TemplateFormController@edit');
    Route::post('template/activate/{id}', 'TemplateFormController@activate');
    Route::resource('templateforms', 'TemplateFormController');
    Route::resource('trainings', 'TrainingController');
    Route::resource('partners', 'PartnerController');
    Route::resource('payments', 'PaymentController');
    Route::resource('users', 'UserController');
    Route::get('/applicant/export/{id}', 'ExportController@applicantExport');
});

Route::get('/applicant/{type}/{id}', 'ApplicantController@setupWebinar');
