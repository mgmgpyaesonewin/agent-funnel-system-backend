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

Route::get('/getForm', 'TemplateFormController@getform');
Route::post('/createuser', 'ApplicantController@createuser');
Route::post('/test', 'ApplicantController@test');

Route::post('/login', 'ApplicantController@login');

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

    Route::post('/applicants/aml/update', 'ApplicantController@updateAML');
});
