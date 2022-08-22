<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\DokterController;

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
});
