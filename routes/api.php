<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CidadeController;
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
    Route::get('/', [CidadeController::class, 'index'])->name('cidades');
    Route::get('/{id}/medicos', [CidadeController::class, 'doctors']
    )->name('cidades.listDoctorByCidadeId');
});

Route::prefix('medicos')->group(function () {
    Route::get('/', [MedicosController::class, 'index'])->name('medicos');
    Route::get('/{id}/medicos', [CidadesController::class, 'doctors']
    )->name('cidades.listDoctorByCidadeId');
});

Route::group(
    ['prefix' => 'medicos'],
    function () {
        Route::get('', [MedicoController::class, 'list'])->name('medicos.list');

        Route::group(
            [
                'middleware' => ['auth:api'],
            ],
            function () {
                Route::post('', [MedicoController::class, 'store'])->name('medicos.store');

                Route::post(
                    '{id_medico}/pacientes',
                    [MedicoController::class, 'storePatientToDoctor']
                )->name('medicos.storePatientToDoctor');

                Route::get(
                    '{id_medico}/pacientes',
                    [PacienteController::class, 'listPatientByMedicoId']
                )->name('medicos.listPatientDoctor');
            }
        );
    }
);
