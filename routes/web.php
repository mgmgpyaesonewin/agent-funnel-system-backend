<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TemplateFormController;
use App\Http\Controllers\BopSessionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

Auth::routes(['register' => false]);

Route::get('pdf', [ExportController::class, 'pdf']);
Route::get('pdf/view', [ExportController::class, 'pdfView']);

Route::get('convert', [SettingController::class, 'convertView']);
Route::post('convert/data', [SettingController::class, 'convertData']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboardAnalytics'])->name('home');

    Route::get('/lead', [ApplicantController::class, 'leadPage']);
    Route::get('/create_lead', [ApplicantController::class, 'create_lead']);
    Route::post('/save_lead', [ApplicantController::class, 'store']);
    Route::get('/pre_filter', [ApplicantController::class, 'preFilterPage']);
    Route::get('/bop_session', [ApplicantController::class, 'bopSessionPage']);
    Route::get('/pru_dna_filter', [ApplicantController::class, 'pruDNAFilter']);
    Route::get('/pmli_filter', [ApplicantController::class, 'pmliFilter']);
    Route::get('/trainee', [ApplicantController::class, 'traineePage']);
    Route::get('/onboarded', [ApplicantController::class, 'onboardedPage']);
    Route::get('/certification', [ApplicantController::class, 'certificationPage']);
    Route::get('/contract', [ApplicantController::class, 'contractPage']);
    Route::get('/applicants/{id}', [ApplicantController::class, 'applicantsDetail']);

    // Setting Dashboards
    Route::get('/setting', [SettingController::class, 'index']);
    Route::post('/setting/update_setting', [SettingController::class, 'update']);
    Route::get('/setting/import_history', [SettingController::class, 'history']);
    Route::get('/setting/download_history/{id}', [SettingController::class, 'download_history']);
    Route::get('/setting/remove_viber_img/{id}', [SettingController::class, 'remove_viber_img']);
    Route::get('/document/{lang}', [SettingController::class, 'document']);
    Route::get('/signatures', [SettingController::class, 'signatures']);
    Route::post('/signatures/update', [SettingController::class, 'updateSignatures']);

    Route::resource('trainings', TrainingController::class);
    Route::resource('templateforms', TemplateFormController::class);
    Route::resource('sessions', BopSessionController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('users', UserController::class);

    Route::get('/training/export/{id}', [TrainingController::class, 'export']);
    Route::get('/api/user/get_bdm_list', [UserController::class, 'get_bdm_list']);

    Route::post('/setting/applicants/export', [ExportController::class, 'applicantsExport']);
    Route::post('/setting/applicants/import', [ExportController::class, 'applicantsImport']);

    Route::get('template/edit/{id}', [TemplateFormController::class, 'edit']);
    Route::post('template/activate/{id}', [TemplateFormController::class, 'activate']);
    Route::get('/applicant/export/{type}/{id}', [ExportController::class, 'applicantExport']);
});

Route::get('/applicant/{type}/{id}', [ApplicantController::class, 'setupWebinar']);
