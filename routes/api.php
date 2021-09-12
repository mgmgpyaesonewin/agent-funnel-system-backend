<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BopSessionController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TemplateFormController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;

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

// FrontEnd API
Route::get('/getForm', [TemplateFormController::class, 'getform']);
Route::post('/createuser', [ApplicantController::class, 'createuser']);
Route::post('/pdf/{id}', [ApplicantController::class, 'signContract']);
Route::post('sign_check', [ApplicantController::class, 'Access_SignBoard']);
Route::post('/bank_update/{id}', [ApplicantController::class, 'bank_info_update']);
Route::get('/payment/{uuid}', [ApplicantController::class, 'validatePayment']);
Route::post('/payment', [ApplicantController::class, 'savePayment']);
Route::post('/detail/{id}', [ApplicantController::class, 'detail']);
Route::post('/spouse_update/{id}', [ApplicantController::class, 'spouse_update']);
Route::get('city', [TemplateFormController::class, 'getCity']);
Route::get('township/{id}', [TemplateFormController::class, 'getTownship']);
Route::post('certificate', [ApplicantController::class, 'certificate']);
Route::post('/login', [ApplicantController::class, 'login']);

// Backend API
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', [UserController::class, 'users']);

    Route::post('/applicants', [ApplicantController::class, 'applicants']);
    Route::post('/applicants/schedule', [ApplicantController::class, 'scheduleAppointment']);
    Route::post('/applicants/update/{id}', [ApplicantController::class, 'update']);
    Route::post('/applicants/training/update/{id}', [ApplicantController::class, 'updateTrack']);
    Route::post('/applicants/assign', [ApplicantController::class, 'assignUserAsAdminForApplicant']);
    Route::post('/applicants/exam', [ApplicantController::class, 'addExamForApplicants']);
    Route::post('/applicant/exam', [ApplicantController::class, 'addExamForApplicant']);
    Route::get('/applicants', [ApplicantController::class, 'searchApplicants']);
    Route::post('/applicants/learning', [ApplicantController::class, 'saveELearningInfo']);
    Route::post('/applicants/aml/update', [ApplicantController::class, 'updateAML']);

    Route::get('/trainings/{applicant_id}', [TrainingController::class, 'getAllTrainings']);
    Route::post('/applicants/export/pmli_filter', [ExportController::class, 'pmliFilterExport']);

    Route::post('/document/save', [SettingController::class, 'updateDocument']);

    Route::get('/sessions', [BopSessionController::class, 'getAllSessions']);
});
