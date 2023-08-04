<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CidadeController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/me', [AuthController::class, 'me'])->name('me');
Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');

Route::get('/user', [UserController::class, 'user'])->name('users')->middleware('auth:api');

Route::prefix('cidades')->group(function () {
    Route::get('/', [CidadeController::class, 'index'])->name('cidade.index');
    Route::get('/{id}/medicos', [CidadeController::class, 'doctors'])->name('cidade.doctors');
});

Route::prefix('medicos')->group(function () {
    Route::get('/', [MedicoController::class, 'index'])->name('medico.index');

    Route::middleware('auth:api')->group(function (): void {
        Route::post('/', [MedicoController::class, 'store'])->name('medico.store');
        Route::get('{id}/pacientes', [MedicoController::class, 'patients'])->name('medico.patients');
        Route::post('{id}/pacientes', [MedicoController::class, 'linkPatient'])->name('medico.linkPatient');
    });
});

Route::prefix('pacientes')->group(function () {
    Route::middleware('auth:api')->group(function (): void {
        Route::put('/{id}', [PacienteController::class, 'edit'])->name('paciente.edit');
        Route::post('/', [PacienteController::class, 'store'])->name('paciente.store');
    });
});
