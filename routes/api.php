<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PatientController;

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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('verification-email/{id_user}/{key}', [UserController::class, 'verificationUser']);
Route::post('verification-result', [UserController::class, 'verificationResult']);
Route::get('gender', [SettingController::class, 'gender']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('update-profile', [UserController::class, 'updateProfile']);

    Route::get('all-specialist', [SpecialistController::class, 'index']);
    Route::post('add-specialist', [SpecialistController::class, 'addSpecialist']);
    Route::post('edit-specialist/{id}', [SpecialistController::class, 'editSpecialist']);
    Route::get('delete-specialist/{id}', [SpecialistController::class, 'deleteSpecialist']);

    Route::get('all-dokter', [DokterController::class, 'index']);
    Route::get('delete-dokter/{id}', [DokterController::class, 'deleteDokter']);
    Route::get('detail-dokter/{id}', [DokterController::class, 'detailDokter']);
    Route::post('add-dokter', [DokterController::class, 'addDokter']);
    Route::post('edit-dokter/{id}', [DokterController::class, 'editDokter']);

    Route::get('all-patient', [PatientController::class, 'index']);
    Route::get('detail-patient/{id}', [PatientController::class, 'detailPatient']);

    Route::post('add-appointment', [AppointmentController::class, 'addAppointment']);
    Route::get('detail-appointment/{id}', [AppointmentController::class, 'detailAppointment']);
    Route::get('all-appointment', [AppointmentController::class, 'allAppointment']);
    Route::get('all-user-appointment', [AppointmentController::class, 'allUserAppointment']);
    Route::get('update-status-appointment/{id}/{status}', [AppointmentController::class, 'updateStatusAppointment']);
    Route::get('get-queue-appointment', [AppointmentController::class, 'getQueueAppointment']);

    Route::post('add-consultation', [ConsultationController::class, 'addConsultation']);
    Route::post('add-detail-consultation', [ConsultationController::class, 'addDetailConsultation']);
    Route::get('get-consultation', [ConsultationController::class, 'getConsultation']);
    Route::get('get-detail-consultation/{id}', [ConsultationController::class, 'getDetailConsultation']);
});
