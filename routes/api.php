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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     dd(auth('api')->user());

//     return $request->user();
// });

// FrontEnd API
Route::get('/getForm', 'TemplateFormController@getform');
Route::post('/createuser', 'ApplicantController@createuser');
Route::post('/pdf/{id}', 'ApplicantController@signContract');
Route::post('sign_check', 'ApplicantController@Access_SignBoard');
Route::post('/bank_update/{id}', 'ApplicantController@bank_info_update');
Route::get('/payment/{uuid}', 'ApplicantController@validatePayment');
Route::post('/payment', 'ApplicantController@savePayment');
Route::post('/detail/{id}', 'ApplicantController@detail');
Route::post('/spouse_update/{id}', 'ApplicantController@spouse_update');
Route::get('city', 'TemplateFormController@getCity');
Route::get('township/{id}', 'TemplateFormController@getTownship');
Route::post('certificate', 'ApplicantController@certificate');
Route::post('/login', 'ApplicantController@login');

// Backend API
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', 'UserController@users');
    Route::post('/applicants', 'ApplicantController@applicants');
    Route::post('/applicants/schedule', 'ApplicantController@scheduleAppointment');
    Route::post('/applicants/update/{id}', 'ApplicantController@update');
    Route::post('/applicants/training/update/{id}', 'ApplicantController@updateTrack');
    Route::post('/applicants/assign', 'ApplicantController@assignUserAsAdminForApplicant');
    Route::post('/applicants/exam', 'ApplicantController@addExamForApplicants');
    Route::post('/applicant/exam', 'ApplicantController@addExamForApplicant');
    Route::get('/applicants', 'ApplicantController@searchApplicants');

    Route::get('/trainings/{applicant_id}', 'TrainingController@getAllTrainings');
    Route::post('/applicants/export/pmli_filter', 'ExportController@pmliFilterExport');

    Route::post('/applicants/learning', 'ApplicantController@saveELearningInfo');

    Route::post('/applicants/aml/update', 'ApplicantController@updateAML');
    Route::post('/document/save', 'SettingController@updateDocument');

    Route::get('/sessions', 'BopSessionController@getAllSessions');
});
